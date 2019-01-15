<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

 
//后台首页
Route::rule('/admin/index','admin/LoginController/index');
//用户列表
Route::get('/admin/user_index','admin/UserController/index');

//后台添加用户列表
Route::rule('/admin/user_create','admin/UserController/create');
//执行后台用户添加
Route::rule('/admin/user_save','admin/UserController/save');
//执行后台删除
Route::rule('/admin/user_delete/:id','admin/UserController/delete');
//后台修改页面
Route::rule('/admin/user_edit/:id','admin/UserController/edit');
//执行用户修改
Route::rule('/admin/user_update/:id','admin/UserController/update');
//修改密码页面
Route::rule('/admin/user_updatepwd/:id','admin/UserController/updatepwd');
//执行修改密码
Route::rule('/admin/user_reupdatepwd/:id','admin/UserController/reupdatepwd');
//用户启用
Route::rule('/admin/user_start/:id','admin/UserController/start');
//用户禁用
Route::rule('/admin/user_stop/:id','admin/UserController/stop');

//分类管理路由组   
Route::group(['name'=>'/admin','prefix'=>'admin/TypeController/'],function(){
//显示分类列表页面
Route::rule('type_index','index','get');   //get 表示用什么方式请求的    url是用a链接请求的，所以要用get不能用post
//添加分类页面
Route::rule('type_create/[:id]','create');

//删除分类
Route::rule('type_delete/:id','delete');
//添加分类页面
Route::rule('type_create/:id','create');
//执行分类
Route::rule('type_save','save');

//x修改分类页面
Route::rule('type_edit/:id','edit');
//执行修改分类
Route::rule('type_update/:id','update');

});


//商品 管理路由组   
Route::group(['name'=>'/admin','prefix'=>'admin/GoodsController/'],function(){
//显示商品列表页面
Route::rule('goods_index','index','get');   //get 表示用什么方式请求的    url是用a链接请求的，所以要用get不能用post
//商品添加页面
Route::rule('goods_create','create');   //get 表示用什么方式请求的    url是用a链接请求的，所以要用get不能用post
//执行商品添加
Route::rule('goods_save','save');
//执行商品删除
Route::rule('goods_delete/:id','delete');
//商品修改页面
Route::rule('goods_edit/:id','edit');
//执行商品修改
Route::rule('goods_update/:id','update');

});

//网站配置
Route::rule('/admin/config_index','admin/ConfigController/index');
//用户启用
Route::rule('/admin/config_start/:id','admin/ConfigController/start');
//用户禁用
Route::rule('/admin/config_stop/:id','admin/ConfigController/stop');
//修改网站配置页面
Route::rule('/admin/config_edit/:id','admin/ConfigController/edit');
//执行修改网站配置
Route::rule('/admin/config_update/:id','admin/ConfigController/update');
