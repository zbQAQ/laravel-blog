<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台登录路由
Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code', 'Admin\LoginController@code');

//后台管理系统路由
Route::group(['middleware' => ['web','admin.login'], 'prefix'=>'admin', 'namespace'=> 'Admin'], function(){

		//主页
		Route::get('/', 'IndexController@index');
		Route::get('/index', 'IndexController@index');
		Route::get('info', 'IndexController@info');
		//退出登录
		Route::get('quit', 'LoginController@quit');
		//修改密码
		Route::any('pass', 'IndexController@pass');

		//文章分类
		Route::resource('category','CategoryController');
		Route::post('cate/changeorder', 'CategoryController@changeOrder');

		//文章
		Route::resource('article','ArticleController');

		//友情链接
		Route::resource('links','LinksController');
		Route::post('links/changeorder', 'LinksController@changeOrder');

		//异步上传图片
		Route::any('upload', 'CommonController@upload');

		//商品
		Route::resource('goods','GoodsController');
		Route::resource('goodsCate','GoodsCateController');
});


// Route::group(['middleware' => 'api', 'prefix'=>'api', 'namespace'=> 'Api'], function(){
// 	Route::get('/test', 'ApiController@index'); 
// });

