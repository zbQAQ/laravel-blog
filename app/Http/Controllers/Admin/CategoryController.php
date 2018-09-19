<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;  
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index() {
    	// echo "get.admin/category";
    	$category = (new Category) -> tree();
    	// dd($category);
    	return view('admin.category.index')->with('data', $category);
    }

    //修改排序
    public function changeOrder() {
        $input = Input::all();

        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];

        if( !is_numeric($input['cate_order']) ) {
            $res = false;
        }else{
            $res = $cate->update();
        }
        if($res){
            $data = [
                'status' => 0,
                'msg' => '分类排序成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类排序失败，请稍后重试',
            ];
        }

        return $data;
    }

    //get.admin/category/create 添加分类
    public function create() {
        // echo "string";

        $data = Category::where('cate_pid', 0)-> get();

        return view('admin.category.add')->with('data', $data);
    }

    //post.admin/category  添加分类提交
    public function store() {
        $input = Input::except('_token');
        $rules = [
            'cate_name' => 'required',
        ];

        $message = [
            'cate_name.required' => '分类名称不能为空!',
        ];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){
            
            // dd($input);

            $res = Category::create($input);

            if($res) {
                return redirect('admin/category');
            }else{
                return back()->with('errors', '数据填充失败，请稍后重试!');
            }


        }else{
            // dd($validator->errors()->all());
            return back()->withErrors($validator);
        }
    }

    //get.admin/category/{category}/edit 编辑分类
    public function edit($cate_id) {

        // echo $cate_id;

        $field = Category::find($cate_id);
        $data = Category::where('cate_pid', 0)-> get();
        // dd($field);

        return view('admin.category.edit', compact('field','data'));
    }

    //put.admin/category/{category}  更新分类
    public function update($cate_id) {
        $input = Input::except('_token','_method');

        $res = Category::where('cate_id', $cate_id) -> update($input);

        if($res) {
            return redirect('admin/category');
        }else{
            return back()->with('errors', '分类信息更新失败，请稍后重试!');
        }
    }



    //get.admin/category/{category} 显示单个分类
    public function show() {

    }
    
    //delete.admin/category/{category}  删除单个分类
    public function destroy($cate_id) {
        // echo "string";

        $res = Category::where('cate_id', $cate_id)->delete();
        Category::where('cate_pid', $cate_id)->update(['cate_pid'=>0]);
        if($res) {

            $data = [
                'status' => 0,
                'msg' => '分类删除成功',
            ];

        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];

        }

        return $data;

    }
    



}
