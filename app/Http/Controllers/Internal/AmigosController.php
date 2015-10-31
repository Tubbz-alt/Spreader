<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Amigo;

use Redirect;

class AmigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.amigos.index')->withAmigos(Amigo::all());
    }

    public function getAmigos(Request $request)
    {
        $amigos = Amigo::where('name', 'like', '%'.$request->input('s').'%')->get();
        return response()->json($amigos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.amigos.create');
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
            'name' => 'required',
            'mobile_phone' => 'required|unique:amigos'
        ]);

        $amigo = new Amigo();
        $amigo->name = $request->input('name');
        $amigo->mobile_phone = $request->input('mobile_phone');
        $amigo->qq = $request->input('qq');
        $amigo->wechat = $request->input('wechat');
        $amigo->alipay = $request->input('alipay');
        $amigo->grade = $request->input('grade');
        $amigo->evaluate = $request->input('evaluate');

        if ($amigo->save()) {
            return Redirect::to('internal/amigos');
        } else {
            return Redirect::back()->withInput()->withErrors('提交失败！');
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
        return view('internal.amigos.edit')->withAmigo(Amigo::find($id));
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
            'name' => 'required',
            'mobile_phone' => 'required'
        ]);

        $amigo = Amigo::find($id);
        $amigo->name = $request->input('name');
        $amigo->mobile_phone = $request->input('mobile_phone');
        $amigo->qq = $request->input('qq');
        $amigo->wechat = $request->input('wechat');
        $amigo->alipay = $request->input('alipay');
        $amigo->grade = $request->input('grade');
        $amigo->evaluate = $request->input('evaluate');

        if ($amigo->save()) {
            return Redirect::to('internal/amigos');
        } else {
            return Redirect::back()->withInput()->withErrors('更新失败！');
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
