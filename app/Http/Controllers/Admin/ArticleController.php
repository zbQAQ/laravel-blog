<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
 	//get.admin/article  全部文章列表
    public function index() {

    	// echo '全部文章列表';

        $data = Article::orderBy('art_id', 'desc')->paginate(8);

        return view('admin.article.index', compact('data'));

    }

    //get.admin/article/create 添加文章
    public function create() {
        // echo "添加文章";
    	$data = (new Category) -> tree();//获取分类

        return view('admin.article.add', compact('data'));

    }

    //post.admin/article  添加文章提交
    public function store() {
        
        $input = Input::except('_token');
        $input['art_time'] = time();

        $rules = [
            'art_title' => 'required',
            'art_content' => 'required',
        ];

        $message = [
            'art_title.required' => '文章标题不能为空!',
            'art_content.required' => '文章内容不能为空!',
        ];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){

            $res = Article::create($input);

            if($res) {
                return redirect('admin/article');
            }else{
                return back()->with('errors', '数据填充失败，请稍后重试!');
            }


        }else{
            // dd($validator->errors()->all());
            return back()->withErrors($validator);
        }

    }
    //get.admin/article/{article}/edit 编辑文章
    public function edit($art_id) {

        // echo $art_id;
        $data = (new Category) -> tree();//获取分类
        $field = Article::find($art_id);
        return view('admin.article.edit', compact('data','field'));
    }

    //put.admin/article/{article}  更新分类
    public function update($art_id) {
        $input = Input::except('_token','_method');

        $res = Article::where('art_id', $art_id) -> update($input);

        if($res) {
            return redirect('admin/article');
        }else{
            return back()->with('errors', '文章信息更新失败，请稍后重试!');
        }
    }

    //get.admin/article/{article} 显示单个文章
    public function show() {

    }
    
    //delete.admin/category/{category}  删除单个文章
    public function destroy($art_id) {
        // echo "string";
        $res = Article::where('art_id', $art_id)->delete();
        if($res) {

            $data = [
                'status' => 0,
                'msg' => '文章删除成功',
            ];

        }else{
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试！',
            ];

        }

        return $data;

    }

}

