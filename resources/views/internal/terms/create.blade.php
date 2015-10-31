@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="panel panel-default">
            <div class="panel-heading">添加场景</div>
            <div class="panel-body">
                @include('partial.errors')

                <form class="form-horizontal" action="{{ URL('internal/terms') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">场景</label>
                        <div class="col-md-8"><input id="" class="form-control" type="text" name="name" value="{{ old('name') }}"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="remark">备注</label>
                        <div class="col-md-8">
                            <textarea id="" class="form-control" name="remark" cols="30" rows="5">{{ old('remark') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-default">提交</button>
                        </div>
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>
@endsection
