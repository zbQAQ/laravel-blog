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
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 修改商品
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑商品</h3>
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
                <a href="{{url('admin/goods')}}"><i class="fa fa-plus"></i>全部商品</a>
                <a href="{{url('admin/goods/create')}}"><i class="fa fa-recycle"></i>添加商品</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/goods/'.$field->goods_id)}}" method="post">

            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}

            <table class="add_tab">
                <tbody>
                    <tr>
                        <!-- <i class="require">*</i> -->
                        <th width="120">分类：</th>
                        <td>
                            <select name="goods_cate_id">
                                @foreach($data as $v)
                                    <option value="{{$v->gcate_id}}"
                                        @if($v->gcate_id==$field->goods_cate_id) selected @endif
                                        >{{$v->gcate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>商品名称：</th>
                        <td>
                            <input type="text" class="lg" id="goods_name" name="goods_name" value="{{$field->goods_name}}">
                            <div class="show-len">
                                <span class="len">00</span>
                                <span>/</span>
                                <span class="maxlen">30</span>
                            </div>    
                            <span><i class="fa fa-exclamation-circle yellow"></i>最多输入30个字符</span>
                        </td>
                    </tr>
                    <tr>
                        <th>商品说明：</th>
                        <td>
                            <input type="text" class="lg" name="goods_title" value="{{$field->goods_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th>商品价格：</th>
                        <td>
                            <input type="text" class="sm" name="goods_price" value="{{$field->goods_price}}">
                            <div class="stock">
                                <span>商品库存：</span>
                                <input type="text" class="sm" name="goods_stock" value="{{$field->goods_stock}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input class="multiple-url" id="goods_thumb" type="text" size="50" name="goods_thumb"
                                value="{{$field->goods_thumb}}" 
                            >
                            <input id="multiple" class="multiple" type="file" />
                            <input class="multiple-btn" type="button" value="选择图片" />
                            <span><i class="fa fa-exclamation-circle yellow"></i>图片名称不要带 ‘ . ’ </span>

                        </td>
                        <tr>
                        <th></th>
                        <td>
                            <img src="{{url($field->goods_thumb)}}" alt="" class="art-thumb-img" id="goods_thumb_img">
                        </td>
                    </tr>
                    </tr>
                    
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="goods_tag" value="{{$field->goods_tag}}">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="goods_description">{{$field->goods_description}}</textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>商品内容 ( 图片 )：</th>
                        <td class="contentGroup">
                            <input class="cont-multiple-btn" type="button" value="选择内容图片" />
                            <input class="none-btn" type="file" id="cont_imgGroup" multiple>
                            <span><i class="fa fa-exclamation-circle yellow"></i>请将图片修改好后，一次性上传 </span>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td id="tr_Group">

                            @foreach($field->goods_content as $k => $v)
                                <div class="img-show">
                                    <input type="hidden" name="goods_content[{{$k}}]" class="class_goods_content"
                                        value="{{$v}}"
                                    >
                                    <img src="{{url($v)}}" class="cont_img_show" alt="">
                                </div>
                            @endforeach
                            
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



<!-- <script src="{{asset('resources/org/jiaoben5392/js/bootstrap-fileinput.js')}}"></script> -->
<script src="{{asset('resources/views/admin/style/js/img-uploads.js')}}"></script>


<script type="text/javascript">

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
                $("#goods_thumb_img").attr('src', imgFile);
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
                        $('#goods_thumb')[0].value = data.file
                    },
                    error: (data) => {

                        layer.msg(data.msg);
                        $('#goods_thumb')[0].value = data.file
                    }
                })

            };  
            //正式读取文件  
            reader.readAsDataURL(file);
        })
        $(".multiple-btn").click(function () {
            $(".multiple").click();
        });
        
        //异步上传商品内容的图片 可多选
        $("#cont_imgGroup").change( () => {
            var files = $("#cont_imgGroup")[0].files
            $('#tr_Group').empty()
            var imgFile = imgTpBase64(files, () => {
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/upload')}}",
                    async: true,
                    data:{
                        '_token': '{{csrf_token()}}',
                        'imgBaseData': imgFile,
                        'entension': '.jpg'
                    },
                    success: (data) => {

                        layer.msg(data.msg);
                        $.each(imgFile, (index, val) => {
                            $('#tr_Group').append(`
                                <div class="img-show">
                                    <input type="hidden" name="goods_content[`+ index +`]" class="class_goods_content"
                                        value="uploads/`+ data.imgfiles[index] +`"
                                    >
                                    <img src="`+ val +`" class="cont_img_show" alt="">
                                </div>
                            `)
                        })

                    },
                    error: (data) => {
                        layer.msg(data.msg);
                        // $('#goods_thumb')[0].value = data.file
                    }
                })
            })
            
        })

        $(".cont-multiple-btn").click(function () {
            $("#cont_imgGroup").click()
        });



        const Dinput = $('#goods_name')[0] //输入框
        const showLen = $('.len') //即时输入的span
        
        let len = Dinput.value.length
        showLen.html(len)
        Dinput.oninput = () => {
            len = Dinput.value.length
            showLen.html(len)
            if(len > 30) {
                showLen.addClass('danger')
            }else{
                showLen.removeClass('danger')
            }
        }
        if(len > 30) {
            showLen.addClass('danger')
        }else{
            showLen.removeClass('danger')
        }
    })
    
</script>



@endsection