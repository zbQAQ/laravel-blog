<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //

    public function upload(Request $request) {

    	// echo "图片上传";
    	$image = $request->input('imgBaseData'); //上传图片的编码
    	$imageEnd = $request->input('entension'); //上传图片的后缀 带点
    	$imageFile = $request->input('fileName'); //上传图片的临时路径

    	$NewImgName = date("YmdHis")."_".mt_rand(100,999).$imageEnd; //图片名称

    	$path = base_path().'/uploads'; //设置图片保存路径
    	//判断是否有逗号 如果有就截取后半部分
    	if (strstr($image,",")){
		    $image = explode(',',$image);
		    $image = $image[1];
		}

		//设置图片保存路径
		$imageSrc=  $path."/". $NewImgName; 

		$r = file_put_contents($imageSrc, base64_decode($image));

		// 判断图片是否生成成功
		if (!$r) {

			$data = [
				'msg' => '图片上传失败！',
				'file' => '! null',
			];
		   	return $data;
		}else{
		    $data = [
				'msg' => '图片上传成功！',
				'file' => 'uploads/'.$NewImgName,
			];
		   	return $data;;
		}


    }
}
