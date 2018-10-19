<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;
use resources\org\code\Code;

class LoginController extends CommonController
{
    //
    public function login() {
    	// echo "string";
    	//登录 验证
    	if($input = Input::all()){
			
    		$code = new Code();
    		$_code = $code -> get();
    		if( strtoupper($input['code']) != $_code ) {
    			return back()->with('msg', '验证码不正确!');
			}
			
    	$userArr = User::all();  //数据库获取的管理员信息
			foreach($userArr as $v) {
				if($v['user_type'] === '管理员') {
					$user = $v;
				}
			}
    		$_username = $user->user_name; //数据库中user的用户名
    		$_userpass = decrypt($user->user_pass);//数据库中user的密码 并解密
    		$_usertype = $user->user_type; //数据库中user的用户类型

    		if($_username != $input['user_name'] || $_userpass != $input['user_pass'] || $_usertype != $input['user_type']){
    			return back()->with('msg', '用户名或者密码错误!');
    		}
    		//登录成功
    		session(['user'=>$user]);
    		// dd(session('user'));
    		return redirect('admin/index');

    	}else{
    		return view('admin.login');
    	}

    }
    public function quit() {
			session(['user'=>null]);
			return redirect('admin/login');
    }
    public function code() {
			$code = new Code;
    	$code -> make();
    }

}
