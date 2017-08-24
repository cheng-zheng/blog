<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file->isValid()){
            $realPath = $file->getRealPath();//临时文件绝对路径

            $entension = $file -> getClientOriginalExtension();// 后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;//重命名

            $path = $file->move(base_path().'/uploads',$newName);//移动
            $filepath = 'uploads/'.$newName;
            return $filepath;

        }

        //dd($file);
    }
}
