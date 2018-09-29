<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Model\Article;

class ArticleController extends CommonController
{
    //get.api/article  全部文章列表
    public function index() {
    	$data = Article::get();
        
        return $this->Testing($data);
    }
    
    //get.api/article/{article} 显示单个文章
    public function show($art_id) {
        //查看次数自增
        Article::where('art_id', $art_id) -> increment('art_view');
        
        $data = Article::find($art_id);
        return $this->Testing($data);

    }

    //get.api/article/create 添加文章
    public function create() {

    }

    //post.api/article  添加文章提交
    public function store() {
        
    }
    //get.api/article/{article}/edit 编辑文章
    public function edit($art_id) {
        
    }

    //put.api/article/{article}  更新分类
    public function update($art_id) {
        
    }
    
    //delete.api/category/{category}  删除单个文章
    public function destroy($art_id) {
        

    }
}
