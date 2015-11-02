<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRequestLog extends Model
{
    protected $table = 'prequest_logs';

    public $timestamps = false;

    public $fillable = ['project_id', 'activity_id', 'task_id', 'term_id', 'amigo_id', 'request_udid', 'requested_at'];

    /**
     * Prepare hightcharts config.
     *
     * @param string $periodStart 'Y-m-d'
     * @param string $periodEnd 'Y-m-d'
     * @param \App\Project $project
     * @return array
     */
    public static function highchartsConfig($periodStart, $periodEnd, $project, $activity = false) {
        $hourSection = $periodEnd == $periodStart;
        $offset = $hourSection ? 13 : 10;
        $sttSuffix = $hourSection ? ":00:00" : " 00:00:00";
        $scopeWhere = $activity ? "activity_id = :scope_id" : "project_id = :scope_id";
        $scopeId = $activity ? $activity->id : $project->id;

        $pvData = $uvData = $putData = [];
        $pvGets = \DB::select("SELECT count(request_udid) as c, substr(requested_at, 1, $offset) as requested_at FROM prequest_logs WHERE $scopeWhere AND requested_at >= :start_day AND requested_at <= :end_day GROUP BY substr(requested_at, 1, $offset)", ['scope_id' => $scopeId, 'start_day' => $periodStart, 'end_day' => "$periodEnd 24:59:59"]);
        foreach ($pvGets as $pv) {
            $pvData[] = [(strtotime($pv->requested_at.$sttSuffix) + 8*3600)*1000, (int)$pv->c];
        }

        $uvGets = \DB::select("SELECT count(DISTINCT request_udid) as c, substr(requested_at, 1, $offset) as requested_at FROM prequest_logs WHERE $scopeWhere AND requested_at >= :start_day AND requested_at <= :end_day GROUP BY substr(requested_at, 1, $offset)", ['scope_id' => $scopeId, 'start_day' => $periodStart, 'end_day' => "$periodEnd 24:59:59"]);
        foreach ($uvGets as $uv) {
            $uvData[] = [(strtotime($uv->requested_at.$sttSuffix) + 8*3600)*1000, (int)$uv->c];
        }
        
        if (!$hourSection) {
            if ($activity) {
                $putGets = \DB::select('SELECT sum(mission) as c FROM tasks WHERE activity_id = :activity_id', ['activity_id' => $activity->id]);
                foreach ($putGets as $put) {
                    $putData[] = [(strtotime($activity->deadline) + 8*3600)*1000, (int)$put->c];
                }
            } else {
                $putGets = \DB::select('SELECT sum(mission) as c, deadline FROM tasks t INNER JOIN (SELECT id, deadline FROM activities WHERE project_id = :project_id AND deadline BETWEEN :start_day AND :end_day) la ON la.id = t.activity_id GROUP BY activity_id', ['project_id' => $project->id, 'start_day' => $periodStart, 'end_day' => $periodEnd]);
                foreach ($putGets as $put) {
                    $putData[] = [(strtotime($put->deadline) + 8*3600)*1000, (int)$put->c];
                }
            }
        }

        $config = [
            'chart' => ['zoomType' => 'xy'],
            'title' => ['text' => $project->name],
            'subtitle' => ['text' => "$periodStart ~ $periodEnd Pv/Uv 投放量"],
            'xAxis' => [['type' => 'datetime']],
            'yAxis' => [['labels' => ['style' => ['color' => '#89A54E']], 'title' => ['text' => '访问量', 'style' => ['clor' => '#89A54E']]], ['title' => ['text' => '推广投放量'], 'opposite' => true]],
            'tooltip' => ['shared' => true],
            'series' => [[
                'name' => '投放量',
                'type' => 'column',
                'yAxis' => 1,
                'data' => $putData 
            ], [
                'name' => 'Pv',
                'type' => 'spline',
                'data' => $pvData 
            ], [
                'name' => 'Uv',
                'type' => 'spline',
                'data' => $uvData 
            ]]
        ];

        return $config;
    }
}
