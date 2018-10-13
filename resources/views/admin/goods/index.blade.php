@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 商品管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<!-- <div class="search_wrap">
        <div class="result_title">
            <h3>商品列表</h3>
        </div>
    </div> -->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>商品列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                <a href="{{url('admin/goods')}}"><i class="fa fa-plus"></i>全部商品</a>
                <a href="{{url('admin/goods/create')}}"><i class="fa fa-recycle"></i>添加商品</a>
            </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th width="5%" class="tc">ID</th>
                        <th>名称</th>
                        <th width="20%">描述</th>
                        <th width="10%">商品类别</th>
                        <th width="5%">点击</th>
                        <th width="5%">价格</th>
                        <th width="5%">库存</th>
                        <th width="15%">操作</th>
                    </tr>
                    
                    @foreach($field as $k => $v)
                    <tr>
                        <td class="tc">{{$v->goods_id}}</td>
                        <td>
                            <a href="{{url('admin/goods/'.$v->goods_id.'/edit')}}">{{$v->goods_name}}</a>
                        </td>
                        <td>{{$v->goods_title}}</td>
                        

                        <td>{{$v->goods_cate_name}}</td>
                        <td>{{$v->goods_view}}</td>
                        <td>{{$v->goods_price}}</td>
                        <td>{{$v->goods_stock}}</td>
                        <td>
                            <a href="{{url('admin/goods/'.$v->goods_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delGoods({{$v->goods_id}} )">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
               
                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

<style type="text/css">
    .result_content ul li span{
        color: #666;
        padding: 6px 12px;
    }
</style>


<script type="text/javascript">
    
    function delGoods(goods_id) {
        // console.log(art_id)
        layer.confirm('您确定要删除这件商品吗？', {
          btn: ['确定','取消'] //按钮
        }, function(){

          $.post("{{url('admin/goods/')}}/"+ goods_id,
            {'_method':'delete', '_token':'{{csrf_token()}}'}, 
            data => {
                if(data.status == 0){
                    location.href = location.href
                    layer.msg(data.msg, {icon: 6})
                }else{
                    layer.msg(data.msg, {icon: 5})
                }
            }
          );


        }, function(){
          
        }); 

    }

</script>

@endsection