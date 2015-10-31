<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company, App\Project;

use Redirect;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.projects.index')->withProjects(Project::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.projects.create')->withCompanies(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:projects|max:255',
            'promotion_link' => 'required',
            'company_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $project = new Project();
        $project->company_id = $request->input('company_id');
        $project->name = $request->input('name');
        $project->promotion_link = $request->input('promotion_link');
        $project->type = $request->input('type');
        $project->description = $request->input('description');
        $project->status = $request->input('status');
        $project->remark = $request->input('remark');

        if ($project->save()) {
            return Redirect::to(URL('internal/projects/'.$project->id));
        } else {
            return Redirect::back()->withInput()->withErrors('创建失败！');
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
        return view('internal.projects.show')->withProject(Project::find($id));
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
