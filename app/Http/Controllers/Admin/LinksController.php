<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //get.admin/links   全部友情链接
    public function index()
    {
        $data = Links::all();
        //dd($data);
        return view('admin.links.index',compact('data'));
    }
    //排序
    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $re = $link->update();
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
    //get.admin/links/create 添加友情链接
    public function create()
    {
        return view('admin.links.add');
    }

    //get.admin/links/{category}/edit    编辑友情链接
    public function edit($link_id)
    {
        $field = Links::find($link_id);
        return view('admin.links.edit',compact('field'));
    }
    //post.admin/links    添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        $rules = [
            //required不能为空
            'link_name'=>'required',
            'link_url'=>'required',
        ];
        $massage = [
            'link_name.required'=>'友情链接名称不能为空！',
            'link_url.required'=>'友情链接URL不能为空！',
        ];
        $validator = Validator::make($input,$rules, $massage);
        if( $validator->passes() ){
            $re = Links::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','友情链接添加失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    //put.admin/links/{article} //更新分类
    public function update($link_id)//更新
    {
        $input = Input::except('_token','_method');
        $re = Links::where('link_id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','文章更新失败！，请稍后重试');
        }
    }

    //delete.admin/links/{links}  删除
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
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
        //return view('admin.links.add');
    }
}
