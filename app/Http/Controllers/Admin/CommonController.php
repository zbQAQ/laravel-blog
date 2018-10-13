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
			
			$path = base_path().'/uploads'; //设置图片保存路径 项目根目录下的uploads
			
			$res = $this->baseToFile($path, $imageEnd, $image);
			// dd($res);
			// 判断图片是否生成成功
			if (!$res) {

				$data = [
					'msg' => '图片上传失败！',
					'file' => '! null',
				];
				return $data;

			}else{
				if(!$res[1]){
					$res[1] = '';
				}
				$data = [
					'msg' => '图片上传成功！',
					'file' => 'uploads/'.$res[0],
					'imgfiles' => $res[1]
				];
				return $data;

			}

		}
		
		/**
		 * baseToFile 图片base64码转存文件 函数
		 * 
		 * @param $path 图片保存的路径
		 * @param $imageEnd 图片要保存的文件后缀
		 * @param $imgbase64 Array || String 图片的base64码 用来转存成文件
		 * @return $res Boolean 执行结果 
		 * 
		 */
		public function baseToFile($path, $imageEnd, $imgbase64) {
			// dd($imgbase64);
			 //图片名称
			if(is_string($imgbase64)) {
				//如果 为字符串 说明只选择了一张图片 并且 不是图片组形式
				$NewImgName = date("YmdHis")."_".mt_rand(100,999).$imageEnd;
				$imageSrc = $path."/". $NewImgName; 
				if(strstr($imgbase64,",")) {
					$imgbase64 = explode(',',$imgbase64);
					$imgbase64 = $imgbase64[1];
				}
				file_put_contents($imageSrc, base64_decode($imgbase64));
				return array($NewImgName, []);
			}

			//否则就是 数组 || 图片组
			$NewImgName = array();
			foreach($imgbase64 as $k => $v) {
				
				array_push($NewImgName, date("YmdHis")."_".mt_rand(100,999).$k.$imageEnd);
				//设置图片保存路径
				$imageSrc = $path."/". $NewImgName[$k];
				if(strstr($imgbase64[$k],",")) {
					$imgbase64[$k] = explode(',',$imgbase64[$k]);
					$imgbase64[$k] = base64_decode($imgbase64[$k][1]);
				}
				file_put_contents($imageSrc, $imgbase64[$k]);
			}
			return array('null', $NewImgName);
		}

		/**
		 * base64To 图片base64码转存文件 函数
		 * 
		 * @param $imgName 图片要保存的名称
		 * @param $imgbase64 图片的base64码 用来转存成文件
		 * @return $res Boolean 执行结果 
		 * 
		 */

}
