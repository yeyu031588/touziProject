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

Route::get('/','Home\IndexController@index');
Route::any('/register','Home\UserController@register');
Route::post('/login','Home\UserController@login');
Route::get('/signOut','Home\UserController@signOut');
Route::any('/uploadImg', 'UploadController@uploadImg');
Route::group(['namespace'=>'Home','middleware'=>'user'],function(){
    Route::get('/home','UserController@home');
    Route::post('/sendPost','PostController@sendPost');
});
Route::group(['namespace'=>'Admin','middleware'=>'admin'],function(){
    Route::get('/Admin','IndexController@index');
    Route::get('/Admin/main','IndexController@main');
    //会员
    Route::get('/Admin/user','UserController@index');
    Route::any('/Admin/newuser','UserController@newuser');
    Route::any('/Admin/user/profile','UserController@profile');
    Route::any('/Admin/user/drop','UserController@drop');
    Route::any('/Admin/user/registerCount','UserController@registerCount');
    Route::post('/Admin/user/modify','UserController@modify');
    Route::post('/Admin/user/distribution','UserController@distribution');
    Route::get('/Admin/user/trade','UserController@trade');
    Route::get('/Admin/user/alltrade','UserController@alltrade');
    //管理员
    Route::any('/Admin/adminuser','UserController@adminUser');
    Route::any('/Admin/adminprofile','UserController@adminprofile');
    Route::post('/Admin/adminmodify','UserController@adminmodify');
    Route::get('/Admin/addadmin','UserController@addadmin');
    Route::post('/Admin/dropAdmin','UserController@dropAdmin');
    //角色
    Route::get('/Admin/role','UserController@role');
    Route::post('/Admin/dropRole','UserController@dropRole');
    Route::any('/Admin/editRole','UserController@editRole');

    //路由
    Route::any('/Admin/routes','RouteController@routeList');
    Route::post('/Admin/editRoute','RouteController@editRoute');
    Route::post('/Admin/dropRoute/{cid?}','RouteController@dropRoute');
    Route::any('/Admin/routeGroup','RouteController@routeGroup');
    Route::any('/Admin/editGroup','RouteController@editGroup');
    Route::any('/Admin/dropGroup','RouteController@dropGroup');

    //路由权限
    Route::any('/Admin/permissions','RouteController@permissions');
    Route::post('/Admin/rolePremission','RouteController@rolePremission');

    //分类
    Route::get('/Admin/category','CategoryController@cates');

    //内容
    Route::get('/Admin/content/list','ContentController@lists');
    Route::get('/Admin/content/contents','ContentController@contents');
    Route::any('/Admin/content/add','ContentController@add');
    Route::any('/Admin/content/detail','ContentController@detail');
    Route::post('/Admin/content/modify','ContentController@modify');
    //评论
    Route::get('/Admin/commentList','CommentController@commentList');
    Route::get('/Admin/comment/detail','CommentController@detail');
    Route::post('/Admin/comment/modify','CommentController@modify');
    Route::post('/Admin/comment/drop','CommentController@drop');
    Route::get('/Admin/onlineAppointment','SystemController@onlineAppointment');
    Route::get('/Admin/appointDetail','SystemController@appointDetail');
    Route::post('/Admin/appointModify','SystemController@appointModify');
    Route::get('/Admin/buttonAppointment','SystemController@buttonAppointment');
    Route::get('/Admin/complaint','SystemController@complaint');

});

Route::any('/AdminLogin','Admin\LoginController@login');
Route::any('/Admin/layout','Admin\LoginController@layout');
