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

		Route::get('/', 'IndexController@index');
		Route::get('/index', 'IndexController@index');
		
		Route::get('info', 'IndexController@info');
		Route::get('quit', 'LoginController@quit');
		Route::any('pass', 'IndexController@pass');

		Route::resource('category','CategoryController');
		Route::post('cate/changeorder', 'CategoryController@changeOrder');

		Route::resource('article','ArticleController');

		Route::resource('links','LinksController');
		Route::post('links/changeorder', 'LinksController@changeOrder');

		Route::any('upload', 'CommonController@upload');
});


// Route::group(['middleware' => 'api', 'prefix'=>'api', 'namespace'=> 'Api'], function(){
// 	Route::get('/test', 'ApiController@index'); 
// });

