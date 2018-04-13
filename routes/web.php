<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return array(
//        "开发三件套" => array(
//            "barryvdh/laravel-debugbar",
//            "barryvdh/laravel-ide-helper",
//            "mpociot/laravel-test-factory-helpe",
//        ),
//        "Theme" => "facuz/laravel-themes:^3.1",
//        "Tree" => "jiaxincui/closure-table",
//        "LogViewer" => "arcanedev/log-viewer",
//        "pjax" => "spatie/laravel-pjax",
//        "xss"=>"voku/anti-xss",
//    );
//});

Route::group(['middleware' => 'web', 'namespace' => 'Home'], function () {
    Route::get("/", "IndexController@index");
    //文章详情页
    Route::get("archives/{slug}.html", "IndexController@archives");
    //限制每个ip每分钟只能评论三次
    Route::post("comment/{post_id}", "IndexController@comment_create")->middleware(['middleware' => 'throttle:50,1']);
    //清除当前用户的session
    Route::get("logout/{id}", "IndexController@logout");
    //分类下的文章
    Route::get("logout/{id}", "IndexController@logout");
    //标签下的文章
    Route::get("logout/{id}", "IndexController@logout");
    //页面
    Route::group(['prefix' => 'page'], function () {

    });

});

//不需要验证的路由
Route::group(['prefix' => 'Admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login'], function () {
        // 登录页面
        Route::get('/', 'LoginController@index');
        Route::get('index', 'LoginController@index');
        // 后台登录
        Route::post('login', 'LoginController@login');
        // 退出
        Route::get('logout', 'LoginController@logout');
    });
});


Route::group(["namespace" => "Admin", "prefix" => "Admin", "middleware" => "usercheck"], function () {
    //首页
    Route::get("/", "AdminController@index");
    //分类
    Route::group(["prefix" => "metas"], function () {
        //分类列表页
        Route::get("/", "MetasController@index");
        //添加分类
        Route::post("store", "MetasController@store");
        //修改
        Route::get("edit/{id}", "MetasController@edit");
        Route::post("update/{id}", "MetasController@update");
        //软删除
        Route::get("destroy/{id}", "MetasController@destroy");
        //恢复软删除
        Route::get("restore/{id}", "MetasController@restore");
        //彻底删除
        Route::get("delete/{id}", "MetasController@delete");

    });
    //主题
    Route::group(["prefix" => "themes"], function () {
        //主题首页
        Route::get("/", "ThemeController@index");
        //主题列表
        Route::get("set_theme/{theme}", "ThemeController@set_theme");
    });
    //文章
    Route::group(["prefix" => "content"], function () {
        //文章列表页
        Route::get("/", "ContentController@index");
        //添加文章
        Route::get("add", "ContentController@add");
        Route::post("create", "ContentController@create");
    });
    //评论
    Route::group(["prefix" => "comment"], function () {
        //评论列表页
        Route::get("/", "CommentController@index");

        //软删除
        Route::get("destroy/{id}", "CommentController@destroy");
        //恢复软删除
        Route::get("restore/{id}", "CommentController@restore");
        //彻底删除
        Route::get("delete/{id}", "CommentController@delete");

    });
    //设置
    Route::group(["prefix" => "Setup"], function () {
        //基本设置
        Route::group(['prefix' => 'Basicsetup'], function () {

        });
        //评论设置
        Route::group(['prefix'=>'Reviewsettings'],function (){

        });
        //
    });
});
