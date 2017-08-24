<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link rel="shortcut icon" href="{{asset('resources/views/home/img/me.ico')}}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
    <title>blog@chen</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/plugin/jq-comments/css/jquery-comments.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/home/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/home/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/home/css/blog.home.css')}}">
    <!-- 代码高亮 -->
   <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
   <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/highlight.min.js"></script>

</head>
<body>
<nav class="navbar navbar-default nav-black-style" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://chenzz.xyz/blog">CHEN</a>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav navbar-right nav-black-style">
            <li class=""><a href="{{url('/')}}">首页</a></li>
            <li><a href="http://www.chenzz.xyz/chen">关于我</a></li>
            <li><a href="#">SVN</a></li>
        </ul>
    </div>
</nav>
@section('content')

@show
<footer>
    <p>@chen ©2017。所有权保留</p>
</footer>
<!--  -->
<!-- 评论 -->
{{--<script src="{{url('public/plugin/jquery/jquery.min.js')}}"></script>--}}
{{--<script src="{{url('public/plugin/jq-comments/js/jquery-comments.js')}}"></script>--}}
<script src="{{asset('resources/views/home/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/js/bootstrap.js')}}"></script>
<script>
    /*代码高亮*/
    hljs.initHighlightingOnLoad();

</script>
</body>
</html>