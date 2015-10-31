<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Activity, App\Task, App\Amigo, App\Term;

class ProjectsActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $v = \Validator::make($request->all(), [
            'deadline' => 'required',
            'tasks_template' => 'required'
        ]);

        if ($v->fails()) {
            return response()->json($v->errors());
        } else {
            $tasksTemplate = $request->input('tasks_template');
            $tasksLogogram = explode("\n", $tasksTemplate);

            $tasksMatches = [];
            $invalidTasks = [];
            foreach ($tasksLogogram as $k => $taskLogogram) {
                if (preg_match_all('/\#([^\@]*)[^\@]*\@?(.*).*\$(.*).*\=(\d+)(.*)?/', $taskLogogram, $matches)) {
                    $tasksMatches[] = $matches;
                    continue;
                }
                $invalidTasks[] = $k + 1;
            }
            if (!empty($invalidTasks)) {
                return response()->json(['tasks_template' => '第'.implode('，', $invalidTasks).'行任务格式无效！']);
            }

            $activity = new Activity();
            $activity->project_id = $projectId;
            $activity->deadline = $request->input('deadline');
            $activity->tasks_template = $request->input('tasks_template'); 
            $activity->status = 0;

            $activity->save();

            // generate Tasks
            foreach ($tasksLogogram as $k => $taskLogogram) {
                $task = new Task();
                $task->activity_id = $activity->id;

                // scene
                $term = Term::firstOrCreate(['name' => trim($tasksMatches[$k][1][0])]);
                $task->term_id = $term->id;
                $task->term_name = $term->name;

                // amigo
                if (!empty($amigoName = trim($tasksMatches[$k][2][0]))) {
                    $amigo = Amigo::firstOrCreate(['name' => $amigoName]);
                    $task->amigo_id = $amigo->id;
                    $task->amigo_name = $amigo->name;
                }

                $task->reward = trim($tasksMatches[$k][3][0]);
                $task->mission = trim($tasksMatches[$k][4][0]);
                $task->description = $tasksMatches[$k][5][0];
                $task->logogram = $taskLogogram;

                $task->save();
            }

            $this->dispatch(new \App\Jobs\GenerateActivityQRCode($activity->id));
            return response()->json(['status' => 'ok', 'activity' => $activity, 'tasks' => $activity->tasks]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId, $activityId)
    {
        $v = \Validator::make($request->all(), [
            'deadline' => 'required',
            'tasks_template' => 'required'
        ]);

        if ($v->fails()) {
            return response()->json($v->errors());
        } else {
            $activity = Activity::find($activityId);
            $tasks = $activity->tasks;

            $activity->deadline = $request->input('deadline');

            $tasksTemplate = $request->input('tasks_template');
            if ($activity->tasks_template != $tasksTemplate) {
                $tasksLogogram = explode("\n", $tasksTemplate);

                $tasksMatches = [];
                $invalidTasks = [];
                foreach ($tasksLogogram as $k => $taskLogogram) {
                    if (preg_match_all('/\#([^\@]*)[^\@]*\@?(.*).*\$(.*).*\=(\d+)(.*)?/', $taskLogogram, $matches)) {
                        $tasksMatches[] = $matches;
                        continue;
                    }
                    $invalidTasks[] = $k + 1;
                }
                if (!empty($invalidTasks)) {
                    return response()->json(['tasks_template' => '第'.implode('，', $invalidTasks).'行任务格式无效！']);
                }

                $oldTasksLogogram = explode("\n", $activity->tasks_template);
                // replace
                $activity->tasks_template = $request->input('tasks_template'); 

                foreach ($tasksLogogram as $k => $taskLogogram) {
                    if (!isset($oldTasksLogogram[$k]) || $taskLogogram != $oldTasksLogogram[$k]) {
                        // scene
                        $term = Term::firstOrCreate(['name' => trim($tasksMatches[$k][1][0])]);
                        $bundle = [
                            'activity_id' => $activityId,
                            'term_id' => $term->id,
                            'term_name' => $term->name,
                            'reward' => trim($tasksMatches[$k][3][0]),
                            'mission' => trim($tasksMatches[$k][4][0]),
                            'description' => trim($tasksMatches[$k][5][0]),
                            'logogram' => $taskLogogram
                        ];

                        if (!empty($amigoName = trim($tasksMatches[$k][2][0]))) {
                            $amigo = Amigo::firstOrCreate(['name' => $amigoName]);
                            $bundle['amigo_id'] = $amigo->id;
                            $bundle['amigo_name'] = $amigo->name;
                        }

                        // create
                        if (!isset($oldTasksLogogram[$k])) {
                            $tasks[$k] = Task::create($bundle);
                            continue;
                        }
                        // update
                        $tasks[$k]->update($bundle);
                    }
                    unset($oldTasksLogogram[$k]);
                }

                // delete
                foreach ($oldTasksLogogram as $k => $oldTasksLogogram) {
                    $tasks[$k]->delete();
                    unset($tasks[$k]);
                }
            }

            $activity->save();

            $this->dispatch(new \App\Jobs\GenerateActivityQRCode($activity->id));
            return response()->json(['status' => 'ok', 'activity' => $activity, 'tasks' => $tasks]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
