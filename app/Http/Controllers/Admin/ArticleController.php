<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * get.admin/article 全部文章列表
     */
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(10);
        return view('admin.article.index',compact('data'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * get.admin/article/create 添加文章
     */
    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add',compact('data'));
    }
    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     * post.admin/article    添加文章提交
     */
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        $input['art_time'] = time();
        $rules = [
            //required不能为空
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $massage = [
            'art_title.required'=>'分类标题不能为空！',
            'art_content.required'=>'分类名称不能为空！',
        ];
        $validator = Validator::make($input,$rules, $massage);
        if( $validator->passes() ){
            $re = Article::create($input);
            if($re){
                //return view('admin/article');
                $this->index();
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    //get.admin/article/{article}/edit    修改文章
    public function edit($art_id)
    {
        $field = Article::find($art_id);
        $data = (new Category)->tree();
        return view('admin.article.edit',compact('data','field'));
    }
    //put.admin/article/{article} //更新文章
    public function update($art_id)//更新
    {
        $input = Input::except('_token','_method');
        $re = Article::where('art_id',$art_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章更新失败！，请稍后重试');
        }
    }
    //delete.admin/destroy/{article}  删除单个文章
    public function destroy($art_id)
    {
        $re = Article::where('art_id',$art_id)->delete();
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
}
