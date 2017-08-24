<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web'] ], function () {

    Route::get('/', 'Home\IndexController@index');

    Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
    Route::get('/a/{art_id}', 'Home\IndexController@article');
    Route::post('/reply/{art_id}','Home\IndexController@reply');//回复

    Route::any('admin/login','Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');
});

/*
 *  admin.login  中间件
 *  prefix       前缀
 *  namespace   命名空间
 */
Route::group(['middleware' => ['web','admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin' ], function () {

    Route::get('/','IndexController@index');
    Route::get('info','IndexController@info');
    Route::any('pass','IndexController@pass');

    Route::get('quit','LoginController@quit');

    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    //增删改查
    Route::resource('category', 'CategoryController');
    //文章
    Route::resource('article', 'ArticleController');
    //友情链接
    Route::resource('links', 'LinksController');
    Route::post('links/changeorder', 'LinksController@changeOrder');
    //自定义导航
    Route::resource('navs', 'NavsController');
    Route::post('navs/changeorder', 'NavsController@changeOrder');
    //配置模块
    Route::get('config/putfile','ConfigController@putFile');
    Route::resource('config', 'ConfigController');
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::post('config/changecontent', 'ConfigController@changeContent');
    //图片上传
    Route::any('upload','CommonController@upload');
});