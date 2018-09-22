@extends('layouts.admin')
@section('content')
    <!-- 描述编辑文档css -->
    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}
    </style>

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑文章</h3>
            @if(count($errors)>0)
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
                <a href="{{url('admin/article')}}"><i class="fa fa-plus"></i>全部文章</a>
                <a href="{{url('admin/article/create')}}"><i class="fa fa-recycle"></i>添加文章</a>
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
                        <!-- <i class="require">*</i> -->
                        <th width="120">分类：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($data as $v)
                                    <option value="{{$v->cate_id}}"
                                        @if($v->cate_id==$field->cate_id) selected @endif
                                        >{{$v->_cate_name}}</option>
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
                            <input type="text" class="sm" name="art_editor" value="{{$field->art_editor}}">
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input class="multiple-url" id="art_thumb" type="text" size="50" name="art_thumb"
                                value="{{$field->art_thumb}}" 
                            >
                            <input id="multiple" class="multiple" type="file" />
                            <input class="multiple-btn" type="button" value="选择图片" />

                        </td>
                        <tr>
                        <th></th>
                        <td>
                            <img src="{{$field->art_thumb}}" alt="" class="art-thumb-img" id="art_thumb_img">
                        </td>
                    </tr>
                    </tr>
                    
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="art_tag" value="{{$field->art_tag}}">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description">{{$field->art_description}}</textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script id="editor" name="art_content"
                                type="text/plain" style="width:600px;height:200px;">
                                {!! $field->art_content !!}
                            </script>
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

<!-- 描述编辑文档js -->
<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>


<!-- <script src="{{asset('resources/org/jiaoben5392/js/bootstrap-fileinput.js')}}"></script> -->


<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('editor');

    //异步上传图片
    $(function () {
        $('#multiple').change( () => {
            var fileName = $('#multiple')[0].value //获取选择图片的临时路径
            var endindex = fileName.indexOf('.') //获取后缀 . 的下标
            var entension = fileName.substring(endindex) //截取 .开始的后缀 列如 .jpg
            var file = $('#multiple')[0].files[0]
            var reader = new FileReader();  
            //创建文件读取相关的变量  
            var imgFile;  
            reader.onload=function(e) {  
                // alert('文件读取完成');  
                imgFile = e.target.result;  //图片base64码
                // console.log(imgFile);  
                $("#art_thumb_img").attr('src', imgFile);
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/upload')}}",
                    async: true,
                    data:{
                        '_token': '{{csrf_token()}}',
                        'imgBaseData': imgFile,
                        'fileName': fileName,
                        'entension': entension
                    },
                    success: (data) => {

                        layer.msg(data.msg);
                        $('#art_thumb')[0].value = data.file
                    },
                    error: (data) => {

                        layer.msg(data.msg);
                        $('#art_thumb')[0].value = data.file
                    }
                })

            };  
            //正式读取文件  
            reader.readAsDataURL(file);
        })
        $(".multiple-btn").click(function () {
            $(".multiple").click();
        });
    })
</script>



@endsection