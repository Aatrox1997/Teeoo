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
//Home
Route::group(['middleware' => 'web', 'namespace' => 'Home'], function () {
    Route::get("/", "IndexController@index");
    //文章详情页
    Route::get("archives/{slug}.html", "IndexController@archives");
    Route::get("archives",function (){
        return view("errors.404");
    });
    //限制每个ip每分钟只能评论三次
    Route::post("comment/{post_id}", "IndexController@comment_create")->middleware(['middleware' => 'throttle:3,1']);
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

//Admin
Route::group(["namespace" => "Admin", "prefix" => "Admin", "middleware" => "usercheck"], function () {
    //首页
    Route::get("index", "AdminController@index");
    Route::get("baic", "AdminController@baic");
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
    //标签
    Route::group(["prefix" => "tags"],function (){
        //标签首页
        Route::get("/","TagsController@index");
        //修改标签
        Route::get("show/{id}","TagsController@show");
        Route::post("edit","TagsController@edit");
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
        //上传图片
        Route::post("uploadimage", "ContentController@uploadimage");
        //修改文章
        Route::get("edit/{id}","ContentController@edit");
        Route::post("edit/{id}","ContentController@edit");
        //软删除文章
        Route::get("destroy/{id}","ContentController@destroy");
        //恢复软删除文章
        Route::get("restore/{id}", "ContentController@restore");
        //彻底删除文章
        Route::get("delete/{id}", "ContentController@delete");
    });
    //评论
    Route::group(["prefix" => "comment"], function () {
        //评论列表页
        Route::get("/", "CommentController@index");
        //删除评论
        Route::get("delete/{id}", "CommentController@delete");

    });
    //设置
    Route::group(["prefix" => "Setup"], function () {
        //基本设置
        Route::any('Basicsetup', 'SetupController@Basicsetup');
        //个人设置
        Route::any('user', 'SetupController@user');
    });
});


Route::get("sitemap",function (){
   \Spatie\Sitemap\SitemapGenerator::create('http://blog.dqtourism.cc/')->writeToFile(public_path('sitemap.xml'));
});

Route::get("/Teeoo",function (){
    return json_encode(array(
        "开发三件套"=>array(
            "barryvdh"=>array(
                "debugbar"=>"laravel-debugbar",
                "ide-helper"=>"laravel-ide-helper",
                "factory-helper"=>"laravel-test-factory-helper"
            ),
            "Seo"=>"artesaos/seotools",
            "Themes"=>"facuz/laravel-themes",
            "Xss"=>"voku/anti-xss",
            "Gravatar"=>"thomaswelton/laravel-gravatar",
            "Sitemap"=>"spatie/laravel-sitemap",
            "Pjax"=>"spatie/laravel-pjax",
            "Tree"=>"jiaxincui/closure-table",
        )
    ));
});
