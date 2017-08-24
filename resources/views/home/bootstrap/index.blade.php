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
<div class="top-img">
	<div class="container">
		<div class="row" style="padding:20px 0;"">
			  <div class="avatar col-sm-4">
			  	<div class="center-block" style="max-width:100px;>
			  		<a href="#">
				  		<img class="img-thumbnail img-responsive img-circle" src="img/photos.jpg">
			  		</a>
			  		<h3 class="text-center">陈政</h3>
			  	</div>
			  </div>
			  <ul class="texts col-sm-8">
			      <p>XXXXXXXXXXXXXXXXXasdasdsadasdsadasds。</p>
			  </ul>
		</div>
	</div>
</div>


<div class="container">
   <div class="row" >
      <div class="col-sm-8 ">
      	@foreach($data as $d) 
      	<div>
	         <a href="new.html">
	         	<h3>标题：{{$d->art_title}}</h3>
	         
	         	<img src="hj.png">
	         	图片：{{$d->art_thumb}}简述{{$d->art_description}}
	         </a>
	         <small>
	         	$d->art_title， id:{{$d->art_id}} <span class="fa fa-calendar-minus-o"></span>{{$d->art_time}}， 
		         <span class="fa fa-user"></span>:{{$d->art_editor}} 
		         <span class="fa fa-eye"></span>:{{$d->art_view}}
	         </small>
			<div class="page">分页
			        {{$data->links()}}
			</div>
			</p>
		</div>
		<div>
	         @foreach($data as $d) 
	         <h3>标题：{{$d->art_title}}</h3>
	         
	         <img src="hj.png">
	         <a>图片：{{$d->art_thumb}}简述{{$d->art_description}}</a>
	$d->art_title， id:{{$d->art_id}} 时间：{{$d->art_time}}， 作者{{$d->art_editor}}
			<div class="page">分页
			        {{$data->links()}}
			</div>
			</p>
		</div>
      </div>
      <!--******************************************************************-->
      <div class="col-sm-4" >
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


<!-- <footer>
	<p style="background:#eee;">@chen ©2017。所有权保留</p>
</footer> -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>