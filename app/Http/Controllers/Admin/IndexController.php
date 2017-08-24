<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{

    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    //any.更改超级管理员密码
    public function pass()
    {
        /*
         *  Validator   验证
         *  rules       规则
         *  massage     更改错误信息
         */
        if($input = Input::all()){
            //dd($input);
            $rules = [
                //required不能为空  between密码6-20位  confirmed匹配密码
                'password'=>'required | between:6,20 | confirmed',
            ];
            $massage = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];
            $validator = Validator::make($input,$rules, $massage);

            if( $validator->passes()){
                /*
                 * 读取用户->解密->加密->更新密码
                 * */
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);

                if($input['password_o']==$_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功！');
                }else{
                    return back()->with('errors','原密码错误！');
                }

            }else{
               return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }

}
