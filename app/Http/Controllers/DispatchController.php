<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DispatchController extends Controller
{
    public function redirect($projectId, $activityId, $taskId = null)
    {
        $log = \App\DispatchLog::create([
            'project_id' => $projectId,
            'activity_id' => $activityId,
            'task_id' => $taskId,
            'request_uri' => $_SERVER['REQUEST_URI'],
            'remote_addr' => \Request::getClientIp(),
            'remote_port' => $_SERVER['REMOTE_PORT'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
        ]);

        $this->dispatch(new \App\Jobs\LogRedirect($log->id));

        if ($project = \App\Project::find($projectId)) {
            return redirect($project->promotion_link.(strpos($project->promotion_link, '?') ? '&' : '?').'utm_source=xgdt_t'.$taskId);
        } else {
            // Emergency
        }
    }
}
