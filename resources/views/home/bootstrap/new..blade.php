<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/me.ico">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
	<title>blog@chen</title>
	<link rel="stylesheet" type="text/css" href="css/blog.home.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>
<nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" 
         data-target="#example-navbar-collapse">
         <span class="sr-only">切换导航</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CHEN</a>
   </div>
   <div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav">
         <li class="active"><a href="#">首页</a></li>
         <li><a href="#">关于我</a></li>
         <li><a href="#">SVN</a></li>
      </ul>
   </div>
</nav>


<div class="container">
   <div class="row" >
      <div class="col-sm-8 ">
      	<h2 class="text-center c_titile">{{$field->art_title}}</h2>
	    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$field->cat_time)}}</span><span>编辑：{{$field->art_editor}}</span><span>查看次数：{{$field->art_viwe}}</span></p>
	    <ul class="infos">
	      {!! $field->art_content !!}
	    </ul>
	    <div class="nextinfo">
	      @if($article['pre'])<p>上一篇：<a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a></p>@endif
	      @if($article['next'])<p>下一篇：<a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a></p>@endif
	    </div>
      </div>
	  
      <!--******************************************************************-->
      <div class="col-sm-4">
      	<ul>
      	<h5>点击排行</h5>
      		<li><a>@foreach($new as $n)$n->art_id, $n->art_title</a></li>
	        <li><a>点击排行$hot as $h,	$h->art_id, $h->art_title, $h->art_title</a></li>
         </ul>
      </div>
      <div class="col-sm-4">
      	<h5>友情链接</h5>
      	<ul>
      		<li><a>($links as $l)$l->link_url，$l->link_name</a></li>
         </ul>
      </div>
   </div>
</div>


<footer style="position:absolute;bottom:0;background:#eee;width:100%;">
	<p class="text-center">@chen ©2017。所有权保留</p>
</footer>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>