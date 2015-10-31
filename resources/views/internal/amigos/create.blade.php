@extends('layout/internal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">添加人员</div>
            <div class="panel-body">
                @include('partial.errors')

                <form class="form-horizontal" action="{{ URL('internal/amigos') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">姓名</label>
                        <div class="col-md-8">
                            <input id="" class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="mobile_phone">手机号</label>
                        <div class="col-md-8"><input id="" class="form-control" type="text" name="mobile_phone" value="{{ old('mobile_phone') }}"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="qq">QQ</label>
                        <div class="col-md-8"><input id="" class="form-control" type="text" name="qq" value="{{ old('qq') }}"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="wechat">Wechat</label>
                        <div class="col-md-8"><input id="" class="form-control" type="text" name="wechat" value="{{ old('wechat') }}"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="alipay">Alipay</label>
                        <div class="col-md-8"><input id="" class="form-control" type="text" name="alipay" value="{{ old('alipay') }}"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="grade">等级</label>
                        <div class="col-md-8">
                            <select id="" class="form-control" name="grade">
                                <option value="1" @if (old('grade') == 1) selected @endif>1星</option>
                                <option value="2" @if (old('grade') == 2) selected @endif>2星</option>
                                <option value="3" @if (old('grade') == 3) selected @endif>3星</option>
                                <option value="4" @if (old('grade') == 4) selected @endif>4星</option>
                                <option value="5" @if (old('grade') == 5) selected @endif>5星</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="evaluate">评价</label>
                        <div class="col-md-8"><textarea id="" class="form-control" name="evaluate" cols="30" rows="5">{{ old('evaluate') }}</textarea></div>
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
