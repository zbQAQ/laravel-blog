<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//前端API接口
Route::group(['middleware' => 'api', 'namespace'=> 'Api'], function(){

    //获取全部文章
    Route::get('getArticle', 'ArticleController@index');

    //获取单个文章
    Route::get('getArt/{art_id}', 'ArticleController@show');

    //获取全部商品
    Route::get('getGoodslist', 'GoodsController@index');

    //获取单个商品
    Route::get('getGoods/{goods_id}', 'GoodsController@show');

});
