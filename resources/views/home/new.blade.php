@extends('layouts.home')

@section('content')


<div class="container">
   <div class="row article-content" >
      <div class="col-sm-8 ">
          <div class=" row main-content">
            <h2 class="text-center c_titile">{{$field->art_title}}</h2>
            <p class="box_c">
                <time class="d_time">发布时间：{{date('Y-m-d',$field->art_time)}}</time>
                <span>编辑：{{$field->art_editor}}</span>
                <span>查看次数：{{$field->art_view}}</span>
            </p>
              <hr/>
            <ul class="infos">
              {!! $field->art_content !!}
            </ul>
              <hr/>
            <div class="nextinfo">
              @if($article['pre'])<p>上一篇：<a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a></p>@endif
              @if($article['next'])<p>下一篇：<a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a></p>@endif
            </div>
          </div>
        <hr/>
          <!--——————————回复list——————————-->
              <div class="reply-list row">
                  <h3 class="text-center">回复</h3>
                  @foreach($reply as $r)
                      <div class="media">
                          <div class="media-body"><h4 class="media-heading">{{$r->reply_name}}</h4>
                              {!! $r->reply_content !!}
                          </div>
                          <time class="pull-right">{{date('Y-m-d',$r->created_at)}}</time>
                      </div>
                      <hr/>
                  @endforeach
              </div>
          <!--——————————回复框——————————-->
          <div class="reply-frame">
              {!! Form::open(['url'=>'/reply/'.$field->art_id]) !!}
              <div class="form-group">
                  {!! Form::text('reply_name', null,['class'=>'form-control','placeholder'=>'请输入用户名或邮箱']) !!}
              </div>
              <div class="form-group">
                  {!! Form::textarea('reply_content', null, ['class'=>'form-control','placeholder'=>'支持makeDown语法']) !!}
              </div>
              <div>
                  {!! Form::submit('发表评论',['class'=>'btn btn-success']) !!}
              </div>
              {!! Form::close() !!}
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

