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
    Route::get('/Admin/user','UserController@index');
    Route::any('/Admin/newuser','UserController@newuser');
    Route::any('/Admin/user/profile','UserController@profile');
    Route::any('/Admin/user/drop','UserController@drop');
    Route::any('/Admin/user/registerCount','UserController@registerCount');
    Route::post('/Admin/user/modify','UserController@modify');
    Route::any('/Admin/grant/role','GrantController@role');
    Route::any('/Admin/grant/addRole','GrantController@addRole');
    Route::any('/Admin/grant/dropRole','GrantController@dropRole');
    Route::any('/Admin/route','RouteController@routeList');
    Route::any('/Admin/adminuser','UserController@adminUser');
    Route::any('/Admin/adminprofile','UserController@adminprofile');
    Route::post('/Admin/adminmodify','UserController@adminmodify');
    Route::get('/Admin/addadmin','UserController@addadmin');
    Route::post('/Admin/dropAdmin','UserController@dropAdmin');
    Route::get('/Admin/role','UserController@role');
    Route::post('/Admin/dropRole','UserController@dropRole');
    Route::any('/Admin/editRole','UserController@editRole');
    Route::any('/Admin/routes','RouteController@routeList');
    Route::post('/Admin/editRoute','RouteController@editRoute');
    Route::post('/Admin/dropRoute/{cid?}','RouteController@dropRoute');
    Route::any('/Admin/routeGroup','RouteController@routeGroup');
    Route::any('/Admin/editGroup','RouteController@editGroup');


    //内容
    Route::get('/Admin/content/list/{cid?}','ContentController@lists');
    Route::any('/Admin/content/add','ContentController@add');
    Route::any('/Admin/content/detail/{id?}','ContentController@detail');
    Route::post('/Admin/content/modify','ContentController@modify');

    Route::get('/Admin/commentList','CommentController@commentList');

    Route::get('/Admin/onlineAppointment','SystemController@onlineAppointment');
    Route::get('/Admin/appointDetail','SystemController@appointDetail');
    Route::post('/Admin/appointModify','SystemController@appointModify');
    Route::get('/Admin/buttonAppointment','SystemController@buttonAppointment');
    Route::get('/Admin/complaint','SystemController@complaint');

});

Route::any('/AdminLogin','Admin\LoginController@login');
Route::any('/Admin/layout','Admin\LoginController@layout');
