<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';//验证码类

class LoginController extends CommonController
{
    public function login()
    {
        //dd(Crypt::encrypt('123456'));
        if($input = Input::all()){

            $code = new \Code;
            $_code = $code->get();

            if( strtoupper( $input['code'] ) != $_code ){
                return back()->with('msg','验证码错误！');
            }

            $user = User::first();
            if($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return back()->with('msg','用户名或密码错误！');
            }

            session(['user'=>$user]);//登录成功存储
            return redirect('admin');

        }else{
            return view('admin.login');
        }
    }
    //退出 清除session
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

}
