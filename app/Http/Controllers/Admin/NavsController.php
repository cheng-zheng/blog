<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //get.admin/Navs   全部自定义导航
    public function index()
    {
        $data = Navs::all();
        //dd($data);
        return view('admin.navs.index',compact('data'));
    }
    //排序
    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'分类排序更新成功!'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'分类排序更新失败,请稍后重试!'
            ];
        }
        return $data;
    }
    //get.admin/Navs/create 添加自定义导航
    public function create()
    {
        return view('admin.navs.add');
    }

    //get.admin/Navs/{category}/edit    编辑自定义导航
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }
    //post.admin/Navs    添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        $rules = [
            //required不能为空
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        $massage = [
            'nav_name.required'=>'自定义导航名称不能为空！',
            'nav_url.required'=>'自定义导航URL不能为空！',
        ];
        $validator = Validator::make($input, $rules, $massage);
        if( $validator->passes() ){
            $re = Navs::create($input);
            if($re){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','自定义导航添加失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    //put.admin/navs/{article} //更新导航
    public function update($nav_id)//更新
    {
        $input = Input::except('_token','_method');
        $re = Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','文章更新失败！，请稍后重试');
        }
    }

    //delete.admin/Navs/{Navs}  删除
    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'分类删除成功！'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'分类删除失败！请稍后重试'
            ];
        }
        return $data;
    }

    //get.admin/category/{category  显示单个分类信息
    public function show()
    {
        //return view('admin.Navs.add');
    }
}
