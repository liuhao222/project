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

 
// 前台主页
Route::get('/home_index', 'home/HomeController/index');

// 前台登录页
Route::rule('/home/delu_login','home/LoginController/index');

// 前台注册
Route::rule('/home/zhuce_register','home/ZhuController/index');

// 前台用户中心
Route::rule('/home/geren_info','home/UserController/index');

// 前台购物车
Route::rule('/home/gouwu_cart','home/ShopController/index');

// 前台订单
Route::rule('/home/dingdan_order','home/ShopController/Ding');

// 前台订单里收获地址跳转
Route::rule('/home/shouhuo_site','home/ShopController/Shou');

// 前台从商城跳转至结算页
Route::rule('/home/jiesuan_place','home/ShopController/Jiesuan');
 
//后台首页
Route::rule('/admin/index','admin/LoginController/index')->middleware('CheckAdmin');//->middleware('CheckAdmin')
//用户列表
Route::get('/admin/user_index','admin/UserController/index')->middleware('CheckAdmin');

//后台添加用户列表
Route::rule('/admin/user_create','admin/UserController/create')->middleware('CheckAdmin');
//执行后台用户添加
Route::rule('/admin/user_save','admin/UserController/save')->middleware('CheckAdmin');
//执行后台删除
Route::rule('/admin/user_delete/:id','admin/UserController/delete')->middleware('CheckAdmin');
//后台修改页面
Route::rule('/admin/user_edit/:id','admin/UserController/edit')->middleware('CheckAdmin');
//执行用户修改
Route::rule('/admin/user_update/:id','admin/UserController/update')->middleware('CheckAdmin');
//修改密码页面
Route::rule('/admin/user_updatepwd/:id','admin/UserController/updatepwd')->middleware('CheckAdmin');
//执行修改密码
Route::rule('/admin/user_reupdatepwd/:id','admin/UserController/reupdatepwd')->middleware('CheckAdmin');
//用户启用
Route::rule('/admin/user_start/:id','admin/UserController/start')->middleware('CheckAdmin');
//用户禁用
Route::rule('/admin/user_stop/:id','admin/UserController/stop')->middleware('CheckAdmin');

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

})->middleware('CheckAdmin');


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

})->middleware('CheckAdmin');

//网站配置
Route::rule('/admin/config_index','admin/ConfigController/index')->middleware('CheckAdmin');
//用户启用
Route::rule('/admin/config_start/:id','admin/ConfigController/start');
//用户禁用
Route::rule('/admin/config_stop/:id','admin/ConfigController/stop');
//修改网站配置页面
Route::rule('/admin/config_edit/:id','admin/ConfigController/edit');
//执行修改网站配置
Route::rule('/admin/config_update/:id','admin/ConfigController/update');


//后台登录显示页
Route::rule('/admin/login','admin/LoginController/login');
//后台登录执行
Route::rule('/admin/do_login','admin/LoginController/do_login');
//检测用户名是否存在
Route::rule('/admin/search_uname','admin/UserController/search_uname');
//显示验证码
Route::rule('/admin/code','admin/LoginController/code');
//退出登录
Route::rule('/admin/logout','admin/LoginController/logout');


//商品 管理路由组   
Route::group(['name'=>'/admin','prefix'=>'admin/FriendlinkController/'],function(){
// //显示商品列表页面
Route::rule('friendlink_index','index','get');   //get 表示用什么方式请求的    url是用a链接请求的，所以要用get不能用post
// //商品添加页面
Route::rule('friendlink_create','create');   
// //执行商品添加
Route::rule('friendlink_save','save');
// //执行商品删除
Route::rule('friendlink_delete/:id','delete');
// //商品修改页面
Route::rule('friendlink_edit/:id','edit');
// //执行商品修改
Route::rule('friendlink_update/:id','update');

})->middleware('CheckAdmin');
