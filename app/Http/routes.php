<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台登录
Route::any('/admin/login','Admin\LoginController@login');

//验证码路由
Route::get('/admin/code','Admin\LoginController@code');


Route::group(['middleware'=>['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台首页
    Route::get('/index','IndexController@index');
    Route::get('/quit','LoginController@quit');
    Route::any('/pass','IndexController@pass');
    Route::any('/test','IndexController@test');
    Route::any('/article','ArticleController@show');
    Route::resource('/category','CategoryController');
    Route::get('/changeOrder/{cate_id}/cate_order/{cate_order}','CategoryController@changeOrder');
});