@extends('layouts.home')

@section('content')

<div class="top-img">
	<div class="container">
		<div class="row" style="padding:20px 0;">
			  <div class="avatar col-sm-4">
			  	<div class="center-block" style="max-width:100px;">
			  		<a>
			  			<img class="img-thumbnail img-responsive img-circle" src="{{asset('resources/views/home/img/photos.jpg')}}"/>
				  	</a>
			  		<h3 class="text-center">陈政</h3>
			  	</div>
			  </div>
			  <ul class="texts col-sm-8">
			      <p class="text-center">...</p>
			  </ul>
		</div>
	</div>
</div>


<div class="container">
   <div class="row" >
      <div class="col-sm-8 ">
			@foreach($newArticle as $n)
			<div class="row article-list">
				 <a href="{{url('a'.'/'.$n->art_id)}}">
					<h3>{{$n->art_title}}</h3>
					 @if(isset($n->art_thumb))<img src="{{$n->art_thumb}}">@endif
					 {{$n->art_description}}
				 </a>
				 <small>
					 <time><i class="fa fa-calendar-minus-o"></i>:{{date('m月d日',$n->art_time)}}&nbsp;</time>
					 <span><i class="fa fa-user"></i>:{{$n->art_editor}}&nbsp;</span>
					 <span class="art_view"><i class="fa fa-eye"></i>:{{$n->art_view}}</span>
				 </small>
			</div>
		    @endforeach
		  <div class="page text-center">
			  {{$newArticle->links()}}
		  </div>

      </div>
      <!--******************************************************************-->
	   <div class="col-sm-4 right-list" >
		   <ul class="article-list">
			   <strong>点击排行</strong>
			   @foreach($hot as $h)
				   <li><a href="{{url('a/'.$h->art_id)}}"><i class="fa fa-reorder"></i> {{$h->art_title}}</a></li>
			   @endforeach
		   </ul>
	   </div>
	   <div class="col-sm-4 right-list">
		   <ul class="article-list">
			   <strong>友情链接</strong>
			   @foreach($links as $l)
				   <li><a href="{{$l->link_url}}"><i class="fa fa-reorder"></i> {{$l->link_name}}</a></li>
			   @endforeach
		   </ul>
	   </div>
   </div>
</div>
@endsection


