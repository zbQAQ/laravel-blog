<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //get.admin/links  全部 友情链接 列表
    public function index() {
    	// echo "get.admin/links";

    	$data = Links::orderBy('link_order', 'asc')->get();

    	return view('admin.links.index', compact('data'));
    	
    }

    //修改链接的排序
    public function changeOrder() {
        $input = Input::all();

        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];

        if( !is_numeric($input['link_order']) ) {
            $res = false;
        }else{
            $res = $link->update();
        }
        if($res){
            $data = [
                'status' => 0,
                'msg' => '友情链接修改排序成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '友情链接排序失败，请稍后重试',
            ];
        }

        return $data;
    }


    //get.admin/links/{links} 显示单个友情链接
    public function show() {

    }

    //get.admin/links/create 添加友情链接
    public function create() {
        //echo "admin/links/create 添加分类";

        return view('admin.links.add');
    }

    //post.admin/links  添加友情链接提交
    public function store() {
        $input = Input::except('_token');

        // dd($input);

        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];

        $message = [
            'link_name.required' => '友情链接名称不能为空!',
            'link_url.required' => '友情链接地址不能为空!',
        ];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){
            
            // dd($input);

            $res = Links::create($input);

            if($res) {
                return redirect('admin/links');
            }else{
                return back()->with('errors', '数据填充失败，请稍后重试!');
            }


        }else{
            // dd($validator->errors()->all());
            return back()->withErrors($validator);
        }
    }

    //get.admin/links/{links}/edit 编辑链接
    public function edit($link_id) {

        // echo $cate_id;

        $field = Links::find($link_id);
        // dd($field);

        return view('admin.links.edit', compact('field'));
    }

    //put.admin/links/{links}  更新链接
    public function update($link_id) {
        $input = Input::except('_token','_method');
        // dd($input);
        $res = Links::where('link_id', $link_id) -> update($input);

        if($res) {
            return redirect('admin/links');
        }else{
            return back()->with('errors', '友情链接信息更新失败，请稍后重试!');
        }
    }


    //delete.admin/links/{links}  删除单个分类
    public function destroy($link_id) {
        // echo "string";

        $res = Links::where('link_id', $link_id)->delete();
        if($res) {

            $data = [
                'status' => 0,
                'msg' => '友情链接删除成功',
            ];

        }else{
            $data = [
                'status' => 1,
                'msg' => '友情链接删除失败，请稍后重试！',
            ];

        }

        return $data;

    }

}
