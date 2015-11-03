@extends('layout/analytics')

@section('content')
<aside id="siderbar" class="col-md-2">
    <div class="list-group">
        <span class="list-group-item list-group-item-header">推广活动</span>
        @foreach ($projects as $project)
            <button type="button" class="list-group-item active">{{ $project->name }}</button>
        @endforeach
    </div>
</aside>

<section id="main" class="col-md-10">
<div class="page-header clearfix">
    <h1>概览</h1>
    <p class="help-block">请选择推广活动和查询条件，查看转化报告。日推广可查看具体某天推广的转化。</p>
    <p class="help-block">PV、UV，分别指页面浏览量、独立访客浏览量。</p>
</div>
<div id="analytics-container">
    <div class="row">
        <div class="col-md-12 input-group">
            <span class="input-group-btn">
                <button class="btn btn-default">7天</button>
                <button class="btn btn-default">14天</button>
                <button class="btn btn-default">30天</button>
            </span>
            <input class="form-control col-10-10" style="border-right: none;" type="text" placeholder="起始时间" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input class="form-control col-10-10" type="text" placeholder="截止时间" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <span class="input-group-btn pull-left">
                <button class="btn btn-primary" type="button"><i class="fa fa-filter"></i> Filter</button>
            </span>
        </div>
    </div>
</div>
</section>

<script src="{{ URL('js/analytics.dashboard.js') }}"></script>
<script>Spreader.Dashboard.init({config: {!! json_encode($config) !!} });</script>
@endsection
