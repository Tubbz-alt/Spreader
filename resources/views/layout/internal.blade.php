<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href="{{ url('css/base.css') }}">
    <script src="{{ url('js/app.js') }}"></script>
</head>
<body>
    <div id="wrapper">
    <nav class="navbar navbar-mast navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('internal')}}"><i class="glyphicon glyphicon-leaf"></i> 小果管理</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown @if (preg_match('/^internal.projects/', \Route::currentRouteName())) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">项目管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li @if (preg_match('/^internal\.projects\.(?!create)/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/projects') }}">项目管理</a></li>
                            <li @if (preg_match('/^internal\.projects\.create/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/projects/create') }}">添加项目</a></li>
                        </ul>
                    </li>
                    <li class="dropdown @if (preg_match('/^internal.terms/', \Route::currentRouteName())) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">场景管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li @if (preg_match('/^internal\.terms\.(?!create)/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/terms') }}"> 场景管理</a></li>
                            <li @if (preg_match('/^internal\.terms\.create/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/terms/create') }}">添加场景</a></li>
                        </ul>
                    </li>
                    <li class="dropdown @if (preg_match('/^internal.amigos/', \Route::currentRouteName())) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">人员管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li @if (preg_match('/^internal\.amigos\.(?!create)/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/amigos') }}">人员管理</a></li>
                            <li @if (preg_match('/^internal\.amigos\.create/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/amigos/create') }}">添加人员</a></li>
                        </ul>
                    </li>
                    <li class="dropdown @if (preg_match('/^internal\.companies/', \Route::currentRouteName())) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">客户案例管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li @if (preg_match('/^internal\.companies\.(?!create)/', \Route::currentRouteName())) class="active" @endif><a href="{{ URL('internal/companies') }}">客户案例</a></li>
                            <li @if (\Route::currentRouteName() == 'internal.companies.create') class="active" @endif><a href="{{ URL('internal/companies/create') }}">添加案例</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL('auth/logout') }}">登出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="content">
        <div class="container">
            @yield('content')
        </div>
    </section>
    </div>
    <footer id="footer" class="container"><p class="text-center">© 2015 XiaoGuo Technology. All Rights Reserved.</p></footer>
    <script>Spreader.init({site_url: "{{ 'http://'.$_SERVER['HTTP_HOST'] }}" })</script>
</body>
</html>
