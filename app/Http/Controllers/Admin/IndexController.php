<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;


class IndexController extends CommonController
{
    //
    public function index() {
    	return view('admin.index');
    }
    public function info() {
    	return view('admin.info');
    }

    //修改密码
    public function pass() {

    	if($input = Input::all()){
    		// dd($input);

    		$rules = [
    			'password' => 'required|between:6,20|confirmed',
    		];

    		$message = [
    			'password.required' => '新密码不能为空!',
    			'password.between' => '新密码必须在6-20位!',
    			'password.confirmed' => '两次输入的密码不匹配!',
    		];

    		$validator = Validator::make($input, $rules, $message);

    		if($validator->passes()){
    			
    			$user = User::first();
    			$_password = Crypt::decrypt($user->user_pass);//数据库取出来解析后的密码
    			if( $input['password_o'] == $_password ){
    				$user->user_pass = Crypt::encrypt($input['password']);
    				$user->update();
    				return back()->with('errors', '密码修改成功!');
    			}else{
    				return back()->with('errors', '原密码错误!');
    			}

    		}else{
    			// dd($validator->errors()->all());
    			return back()->withErrors($validator);
    		}

    	}else{
	    	return view('admin.pass');
    	}
    }
}
