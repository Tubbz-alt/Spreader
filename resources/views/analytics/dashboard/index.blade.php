@extends('layout/analytics')

@section('content')
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

<script src="{{ URL('js/analytics.dashboard.js') }}"></script>
<script>Spreader.Dashboard.init({config: {!! json_encode($config) !!} });</script>
@endsection
