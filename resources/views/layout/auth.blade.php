<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{url('css/auth.css')}}">
</head>
<body>
    <main id="auth-head">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-1 text-left">
                    <span id="auth-logo"><i class="glyphicon glyphicon-leaf"></i></span>
                    <p class="lead">提供专业地推方案，流量跟踪。让地推行之有效。</p>
                </div>
                <div class="col-md-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <div class="main">
        <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <img class="img-responsive" alt="Sass and Less support" src="http://placehold.it/600x250/09f/fff.png">
        <h3>预处理脚本</h3>
        <p>虽然可以直接使用 Bootstrap 提供的 CSS 样式表，不要忘记 Bootstrap 的源码是基于最流行的 CSS 预处理脚本 - <a href="../css/#less">Less</a> 和 <a href="../css/#sass">Sass</a> 开发的。你可以采用预编译的 CSS 文件快速开发，也可以从源码定制自己需要的样式。</p>
      </div>
      <div class="col-sm-4">
        <img class="img-responsive" alt="Responsive across devices" src="http://placehold.it/600x250/09f/fff.png">
        <h3>一个框架、多种设备</h3>
        <p>你的网站和应用能在 Bootstrap 的帮助下通过同一份代码快速、有效适配手机、平板、PC 设备，这一切都是 CSS 媒体查询（Media Query）的功劳。</p>
      </div>
      <div class="col-sm-4">
        <img class="img-responsive" alt="Components" src="http://placehold.it/600x250/09f/fff.png">
        <h3>特性齐全</h3>
        <p>Bootstrap 提供了全面、美观的文档。你能在这里找到关于 HTML 元素、HTML 和 CSS 组件、jQuery 插件方面的所有详细文档。</p>
      </div>
    </div>
        </div>
    </div>
</body>
</html>
