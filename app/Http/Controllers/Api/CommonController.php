<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function Testing($data) {
        if($data) {
            return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
        }else{
            return response()->json(['status'=>0,'msg'=>'error','data'=>null]);
        }
    }
}
