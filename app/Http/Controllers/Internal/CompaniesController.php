<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;

use Redirect;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.companies.index')->withCompanies(Company::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.companies.create');
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
            'name' => 'required|unique:companies|max:255',
            'industry_id' => 'required'
        ]);

        $company = new Company();
        $company->name = $request->input('name');
        $company->industry_id = $request->input('industry_id');

        if ($company->save()) {
            return Redirect::to('internal/companies');
        } else {
            return Redirect::back()->withInput()->withError('创建失败！');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('internal.companies.edit')->withCompany(Company::find($id));
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'industry_id' => 'required'
        ]);

        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->industry_id = $request->input('industry_id');

        if ($company->save()) {
            // TODO
            // return Redirect::to(URL('internal/companies/'.$company->id));
            return Redirect::to(URL('internal/companies'));
        } else {
            return Redirect::back()->withInput()->withErrors('修改失败！'); 
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
        if ($company = Company::find($id)) {
            $company->delete();
        }
        return Redirect(URL('internal/companies'));
    }
}
