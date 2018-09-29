<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use App\Http\Model\GoodsCate;

class GoodsController extends CommonController
{
    ////get.api/goods  全部商品列表
    public function index() {
    	// $data = Goods::orderBy('goods_id', 'desc')->paginate(7); //获取分了页的商品列表

        $goods = Goods::all(); //获取完整的商品列表
        $field =  (new GoodsCate) -> getGoodsCate($goods); //获取处理好分类名字的商品列表。。

        return $this->Testing($field);
    }
    
    //get.api/goods/{goods} 显示单个商品
    public function show($goods_id) {

        //查看次数自增
        Goods::where('goods_id', $goods_id) -> increment('goods_view');

        // $goods = Goods::find($goods_id);
        $goods = Goods::Join('GoodsCate', 'Goods.goods_cate_id', '=', 'GoodsCate.gcate_id')->where('goods_id', $goods_id)->first();
        //$data =  (new GoodsCate) -> getGoodsCate($goods); //获取处理好分类名字的商品

        return $this->Testing($goods);

    }

    //get.api/goods/create 添加商品
    public function create() {

    }

    //post.api/goods  添加商品提交
    public function store() {
        
    }
    //get.api/goods/{goods}/edit 编辑商品
    public function edit($goods_id) {
        
    }

    //put.api/goods/{goods}  更新商品
    public function update($goods_id) {
        
    }
    
    //delete.api/goods/{goods}  删除单个商品
    public function destroy($goods_id) {
        

    }
}