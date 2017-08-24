@extends('layouts.admin')

@section('content')

<!--面包屑导航 开始-->
<div class="crumb_warp">

    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章修改
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>文章管理</h3>
        @if( count($errors)>0 )
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article/'.$field->art_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
                <tr>
                    <th width="120">分类：</th>
                    <td>
                        <select name="cate_id">
                            @foreach($data as $v)
                                <option value="{{$v->cate_id}}"
                                @if($field->cate_id==$v->cate_id) selected @endif>
                                    {{$v->_cate_name}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title" value="{{$field->art_title}}">
                    </td>
                </tr>
                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" name="art_editor" value="{{$field->art_editor}}">
                    </td>
                </tr>
                <tr>
                    <th>缩略图：</th>
                    <td>
                        <input type="hidden" class="lg" name="art_thumb" value="{{$field->art_thumb}}">
                        <img id="art_thumb_img" style="max-width:350px;max-height:100px;" src="/{{$field->art_thumb}}">
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <form>
                            <div id="queue"></div>
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                        </form>
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText':'图片上传',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : '{{csrf_token()}}'
                                    },
                                    'swf'      : '{{asset("resources/org/uploadify/uploadify.swf")}}',
                                    'uploader' : '{{asset("admin/upload")}}',
                                    'onUploadSuccess' : function(file, data, response) {//上传后返回
                                        $('input[name=art_thumb]').val(data);//value赋值
                                        $('#art_thumb_img').attr('src','/'+data);//img赋值
                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify{display:inline-block;}
                            .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="art_tag" value="{{$field->art_tag}}"/>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <input type="text" class="lg" name="art_description" value="{{$field->art_description}}"/>
                    </td>
                </tr>
                {{--<tr>--}}
                    {{--<th>文章内容：</th>--}}
                    {{--<td>--}}
                        {{--<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/Ueditor/ueditor.config.js')}}"></script>--}}
                        {{--<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/Ueditor/ueditor.all.min.js')}}"> </script>--}}
                        {{--<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/Ueditor/lang/zh-cn/zh-cn.js')}}"></script>--}}
                        {{--<style>--}}
                            {{--.edui-default{line-height: 28px;}--}}
                            {{--div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body--}}
                            {{--{overflow: hidden; height:20px;}--}}
                            {{--div.edui-box{overflow: hidden; height:22px;}--}}
                        {{--</style>--}}
                        {{--<div>--}}
                            {{--<script id="editor" type="text/plain" style="max-width:1024px;min-width:600px;width:100%;height:500px;"  name="art_content">{{!! $field->art_content !!}}</script>--}}
                            {{--<script>--}}
                                {{--var editor = UE.getEditor('editor');--}}
                            {{--</script>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                <tr>
                    <th>文章内容：</th>
                    <td>
                        {{--// 引入编辑器代码--}}
                        @include('editor::head')
                        <div class="editor">
                            {{--{!! Form::textarea('content', null, ['class' => 'form-control','id'=>'myEditor']) !!}--}}
                            <textarea class="form-control" id='myEditor' name="art_content">{!! $field->art_content !!}</textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection