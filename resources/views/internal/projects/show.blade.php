@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">项目：P{{ $project->id }}</div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>项目名</dt>
                    <dd>{{ $project->name }}</dd>
                    <dt>客户案例</dt>
                    <dd>{{ $project->company_id }}</dd>
                    <dt>项目描述</dt>
                    <dd>{{ $project->description }}</dd>
                    <dt>推广链接</dt>
                    <dd>{{ $project->promotion_link }}</dd>
                    <dt>项目状态</dt>
                    <dd>{{ $project->status }}</dd>
                    <dt>立项时间</dt>
                    <dd>{{ $project->created_at }}</dd>
                </dl>
            </div>
            <div id="activities-container"></div>
        </div>
    </div>
</div>

<script src="{{ URL('js/internal.project.union.js') }}"></script>
<script>Spreader.Project.init({project: {!! json_encode($project) !!}, activities: {!! json_encode($project->activities) !!}, tasks: {!! json_encode($project->tasks) !!} });</script>
@endsection
