<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsCate extends Model
{
    //

    protected $table = 'goodsCate';
    protected $primaryKey ='gcate_id';
    public $timestamps = false;
    protected $guarded = [];

    //获取商品分类 $cate           $data是传过来的商品列
    public function getGoodsCate($data) {
        $cate = $this->orderBy('gcate_id', 'asc')->get();
        
        return $this->pushCate($data, $cate, 'goods_cate_name', 'goods_cate_id', 'gcate_id');
    }

    public function pushCate($goods, $cate, $new_cate_name, $goods_cate_id, $cate_id) {
        //    $goods是传进来的商品列  $cate是商品分类列  $new_cate_name是商品列要新增字段  
        //    $goods_cate_id是商品的类别ID的字段名, $cate_id是商品分类的id的字段名
        if(count($goods) <= 1){  
            //如果传进来的是单个商品就直接循环商品类别
            foreach($cate as $m => $n) {
                //循环商品类别列 找到商品的分类ID对应的商品分类的id 
                //并把商品类别对应的名字添加到 商品列里
                if( $goods[$goods_cate_id] === $n->$cate_id ){
                    $goods[$new_cate_name] = $cate[$m]['gcate_name'];
                }
            }
        }else{
            foreach($goods as $k => $v) {
                //循环商品列
                foreach($cate as $m => $n) {
                    //循环商品类别列 找到商品的分类ID对应的商品分类的id 
                    //并把商品类别对应的名字添加到 商品列里
                    if( $v->$goods_cate_id === $n->$cate_id ){
                        $goods[$k][$new_cate_name] = $cate[$m]['gcate_name'];
                    }
    
                }
            }
        }
        return $goods;
    }
}
