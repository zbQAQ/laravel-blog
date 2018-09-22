<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use App\Http\Model\GoodsCate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class GoodsController extends CommonController
{
    //get.admin/goods  全部商品列表
    public function index() {

        //$data = Goods::orderBy('goods_id', 'desc')->paginate(3); //获取分了页的商品列表

        $goods = Goods::all(); //获取完整的商品列表
        $field =  (new GoodsCate) -> getGoodsCate($goods); //获取处理好分类名字的商品列表。。

        return view('admin.goods.index', compact('field'));

    }

    //get.admin/goods/create 添加商品
    public function create() {
        
    	$data = GoodsCate::orderby('gcate_view', 'asc') -> get();//获取商品分类
        return view('admin.goods.add', compact('data'));

    }

    //post.admin/article  添加商品提交
    public function store() {
        
        $input = Input::except('_token');
        $input['goods_time'] = time();

        $rules = [
            'goods_title' => 'required',
            'goods_content' => 'required',
        ];

        $message = [
            'goods_title.required' => '商品标题不能为空!',
            'goods_content.required' => '商品内容不能为空!',
        ];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){

            $res = Goods::create($input);

            if($res) {
                return redirect('admin/goods');
            }else{
                return back()->with('errors', '数据填充失败，请稍后重试!');
            }


        }else{
            // dd($validator->errors()->all());
            return back()->withErrors($validator);
        }

    }
    //get.admin/article/{article}/edit 编辑商品
    public function edit($goods_id) {

        // echo $goods_id;
        $data = GoodsCate::orderby('gcate_view', 'asc') -> get();//获取商品分类

        $field = Goods::find($goods_id);
        return view('admin.goods.edit', compact('data','field'));
    }

    //put.admin/article/{article}  更新分类
    public function update($goods_id) {
        $input = Input::except('_token','_method');

        $res = Article::where('goods_id', $goods_id) -> update($input);

        if($res) {
            return redirect('admin/goods');
        }else{
            return back()->with('errors', '商品信息更新失败，请稍后重试!');
        }
    }

    //get.admin/article/{article} 显示单个商品
    public function show() {

    }
    
    //delete.admin/category/{category}  删除单个商品
    public function destroy($goods_id) {
        // echo "string";
        $res = Article::where('goods_id', $goods_id)->delete();
        if($res) {

            $data = [
                'status' => 0,
                'msg' => '商品删除成功',
            ];

        }else{
            $data = [
                'status' => 1,
                'msg' => '商品删除失败，请稍后重试！',
            ];

        }

        return $data;

    }
}
