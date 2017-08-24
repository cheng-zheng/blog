<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    protected $markdown;
   public function __construct(Markdown $markdown)
   {
       $this->markdown = $markdown;
       //点击量最高的5文章
       $hot = Article::orderBy('art_view','desc')->take(5)->get();

       //友情链接
       $links = Links::orderBy('link_order','asc')->get();

       //导航
       $navs = Navs::all();
       View::share('navs',$navs);
       View::share('hot',$hot);
       //View::share('new',$new);
       View::share('links',$links);
   }
}
