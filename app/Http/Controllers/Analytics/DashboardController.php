<?php

namespace App\Http\Controllers\Analytics;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $project = null;

    public function __construct()
    {
        $user = \Auth::user();
        if ($user->role == 2) {
            $this->project = \App\Project::where('company_id', $user->company_id)->orderBy('id', 'DESC')->first();
        } else {
            $this->project = \App\Project::orderBy('id', 'DESC')->first();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = \App\PRequestLog::highchartsConfig(date('Y-m-d', $_SERVER['REQUEST_TIME'] - 7*24*3600), date('Y-m-d', $_SERVER['REQUEST_TIME']), $this->project);
        return view('analytics.dashboard.index')->withConfig($config);
    }

    public function getHightChartsConfig(Request $request)
    {
        if ($request->has('period_day')) {
            $startDay = date('Y-m-d', strtotime($request->input('period_day') . " days"));
            $endDay = date('Y-m-d', $_SERVER['REQUEST_TIME']);
        } else {
            $startDay = $request->input('start_day');
            $endDay = $request->input('end_day');
        }

        $activity = false;
        if ($deadline = $request->input('activity_filter')) {
            $activity = \App\Activity::where('project_id', $this->project->id)->where('deadline', $deadline)->first();
        }

        return response()->json(\App\PRequestLog::highchartsConfig($startDay, $endDay, $this->project, $activity));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
