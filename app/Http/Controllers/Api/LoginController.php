<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class LoginController extends CommonController
{
    public function login(Request $request) {
        //普通用户登录
        $input = Input::all();
        dd($input, $request);
        $rules = [
            'user_name' => 'required',
            'user_pass' => 'required',
        ];
        $message = [
            'user_name.required' => '用户名不能为空!',
            'user_pass.required' => '密码不能为空!',

        ];

        $userData = User::where('user_type', $input['user_type'])->get();

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes()){
            $flag = false;
            foreach($userData as $v) {
                $_username = $v->user_name;
                $_userpass = decrypt($v->user_pass);
                $_usertype = $v->user_type;
                // dd($_username , $input['user_name']);
                if($_username != $input['user_name'] || $_userpass != $input['user_pass'] || $_usertype != $input['user_type']){
                    $flag = false;
                }else{
                    $flag = true;
                    session(['user'=>$v]);
                    return $this->Testing($input, $flag);
                }
            }
            if(!$flag) {
                return $this->Testing('用户名或者密码错误！！', $flag);
            }
        }else{
            // dd($validator->errors()->all());
            // return back()->withErrors($validator);
            return $this->Testing('用户名或者密码不能未空！', false);
        }

        

    }
}
