<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use App\Http\Model\GoodsCate;

class GoodsCateController extends CommonController
{
    ////get.api/goods  全部商品分类列表
    public function index() {
    	// $data = Goods::orderBy('goods_id', 'desc')->paginate(7); //获取分了页的商品列表

        $goodscate = GoodsCate::all(); //获取完整的商品分类列表

        return $this->Testing($goodscate);
    }
    
    //get.api/goods/{goods} 显示单个商品分类
    public function show($gcate_id) {

        //查看次数自增
        // Goods::where('goods_id', $goods_id) -> increment('goods_view');

        $goodscate = GoodsCate::find($gcate_id);

        return $this->Testing($goodscate);

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