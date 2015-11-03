@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">人员管理</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>姓名</th>
                        <th>电话</th>
                        <th>qq</th>
                        <th>wechat</th>
                        <th>alipay</th>
                        <th>grade</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($amigos as $amigo)
                        <tr>
                            <th>{{ $amigo->id }}</th>
                            <td>{{ $amigo->name }}</td>
                            <td>{{ $amigo->mobile_phone }}</td>
                            <td>{{ $amigo->qq }}</td>
                            <td>{{ $amigo->wechat }}</td>
                            <td>{{ $amigo->alipay }}</td>
                            <td>{{ $amigo->grade }} <i class="glyphicon glyphicon-star"></i></td>
                            <td><a href="{{ URL('internal/amigos/'.$amigo->id.'/edit') }}">编辑</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $amigos->render() !!}
    </div>
</div>
@endsection
