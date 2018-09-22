<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\GoodsCate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class GoodsCateController extends CommonController
{
    //get.admin/goodsCate  全部商品分类列表
    public function index() {

        $gcate = GoodsCate::all();
    	return view('admin.goodsCate.index')->with('data', $gcate);
    }

    //get.admin/goodsCate/create 添加商品分类
    public function create() {
        // echo "string";
        return view('admin.goodsCate.add');
    }

    //post.admin/goodsCate  添加商品分类提交
    public function store() {
        $input = Input::except('_token');
        $rules = [
            'gcate_name' => 'required',
        ];

        $message = [
            'gcate_name.required' => '商品分类名称不能为空!',
        ];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){
            
            // dd($input);

            $res = GoodsCate::create($input);

            if($res) {
                return redirect('admin/goodsCate');
            }else{
                return back()->with('errors', '数据填充失败，请稍后重试!');
            }


        }else{
            // dd($validator->errors()->all());
            return back()->withErrors($validator);
        }
    }

    //get.admin/goodsCate/{goodsCate}/edit 编辑商品分类
    public function edit($gcate_id) {

        // echo $cate_id;

        $field = GoodsCate::find($gcate_id);
        // dd($field);
        return view('admin.goodsCate.edit', compact('field'));
    }

    //put.admin/goodsCate/{goodsCate}  更新商品分类
    public function update($gcate_id) {
        $input = Input::except('_token','_method');

        $res = GoodsCate::where('gcate_id', $gcate_id) -> update($input);

        if($res) {
            return redirect('admin/goodsCate');
        }else{
            return back()->with('errors', '商品分类信息更新失败，请稍后重试!');
        }
    }



    //get.admin/goodsCate/{goodsCate} 显示单个商品分类
    public function show() {

    }
    
    //delete.admin/goodsCate/{goodsCate}  删除单个商品分类
    public function destroy($gcate_id) {
        // echo "string";

        $res = GoodsCate::where('gcate_id', $gcate_id)->delete();
        if($res) {

            $data = [
                'status' => 0,
                'msg' => '商品分类删除成功',
            ];

        }else{
            $data = [
                'status' => 1,
                'msg' => '商品分类删除失败，请稍后重试！',
            ];

        }

        return $data;

    }
    
}
