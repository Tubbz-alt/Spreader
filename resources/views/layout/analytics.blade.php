<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{url('css/analytics.css')}}">
    <script src="{{ url('js/app.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-mast navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('analytics')}}"><i class="fa fa-line-chart"></i> 小果统计</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="">Uv/Pv</a></li>
                    <li><a href="">活动现场反馈</a></li>
                    <li><a href="">活动记录</a></li>
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
    <div class="main">
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>
