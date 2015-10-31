@extends('layout/auth')

@section('content')
<div id="auth-title">登录小果</div>
<form class="form-horizontal" action="/auth/login" method="POST">
    {!! csrf_field() !!}
    <div class="form-group">
        <div class="col-md-8">
            <input id="" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="用户名 或 邮箱">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <input id="" class="form-control" type="password" name="password" placeholder="密码">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 text-left">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> 记住我
                </label>
            </div>
        </div>
    </div>

    <div class="form-group text-left">
        @include('partial/errors')
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <button type="submit" class="btn btn-default col-md-12">登录</button>
        </div>
    </div>
</form>
@endsection
