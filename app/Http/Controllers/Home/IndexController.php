<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    //首页
    public function index()
    {
        //点击量最高的6文章(站长推荐)
        //$pics = Article::orderBy('art_view','desc')->take(6)->get();

        //图文列表5篇(带分页)
        $newArticle = Article::orderBy('art_time','desc')->paginate(5);

        //最新文章8篇
        //$new = Article::orderBy('art_time','desc')->take(8)->get();
        return view('home/index',compact('newArticle'));
    }

    public function cate($cate_id)
    {
        //图文列表5篇(带分页)
        $data = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);

        //当前分类的子分类
        $submenu = Category::where('cate_id',$cate_id)->get();
        $field = Category::find($cate_id);

        return view('home/list',compact('data','submenu','field'));
    }

    /**
     * @param $art_id
     * @param Markdown $markdown
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function article($art_id)
    {
        $reply = Reply::where('reply_bind',$art_id)->get();//回复
        foreach($reply as $re=>$r){
            //回复列表 markDown 解析
            $reply[$re]->reply_content = $this->markdown->html($r->reply_content);
        }
        //
        $field = Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        $html = $this->markdown->html($field->art_content);
        $field->art_content = $html;
        //上一篇 下一篇
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

        $data = Article::where('cate_id',$field->cate_id)->
orderBy('art_id','desc')->take(6)->get();
        //查看次数自增
        //Article::where('art_id',$art_id)->increment('art_view',1);
        return view('home/new',compact('field','article','data','reply'));
    }

    /**
     * @param $art_id
     */
    public function reply($art_id){
        $input = Input::except('_token');
        $input['created_at'] = time();
        $input['reply_bind'] = $art_id;
        //dd($input);
        $rules = [
            'reply_name'=>'required',//required不能为空
            'reply_content'=>'required',
        ];
        $massage = [
            'reply_name.required'=>'名称不能为空',
            'reply_content.required'=>'内容不能为空',
        ];
        $validator = Validator::make($input,$rules, $massage);
        if( $validator->passes() ){
            $re = Reply::create($input);
            if($re){
                return redirect()->back();
            }else{
                return back()->with('errors','回复失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
}
