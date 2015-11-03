@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">项目管理</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>项目</th>
                        <th>公司_产品名</th>
                        <th>活动名</th>
                        <th>类型</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th><a href="{{ URL('internal/projects/'.$project->id) }}">P{{ $project->id }}</a></th>
                            <td>{{ $project->company_id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ \App\project::$types[$project->type] }}</td>
                            <td>{{ \App\project::$status[$project->status] }}</td>
                            <td>{{ $project->created_at }}</td>
                            <td><a href="{{ URL('internal/projects/'.$project->id.'/edit') }}">修改</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $projects->render() !!}
    </div>
</div>
@endsection
