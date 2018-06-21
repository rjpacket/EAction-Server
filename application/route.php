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

use think\Route;

Route::resource('test', 'api/test');



Route::get('api/:ver/cat', 'api/:ver.cat/read');

Route::get('api/:ver/index', 'api/:ver.index/index');

//News
Route::resource('api/:ver/news', 'api/:ver.news');

//Rank
Route::get('api/:ver/rank', 'api/:ver.rank/index');

//更新
Route::get('api/:ver/init', 'api/:ver.index/init');

//首页
Route::get('api/:ver/home', 'api/:ver.home/read');

//获取验证码
Route::post('api/:ver/getcode', 'api/:ver.getcode/save');

//登录
Route::post('api/:ver/login', 'api/:ver.login/save');

//退出登录
Route::post('api/:ver/logout', 'api/:ver.logout/save');

//用户信息
Route::resource('api/:ver/user', 'api/:ver.user');

//设置头像，先获取上传方法
Route::post('api/:ver/image', 'api/:ver.image/save');

//点赞
Route::post('api/:ver/upvote', 'api/:ver.upvote/save');
Route::delete('api/:ver/upvote', 'api/:ver.upvote/delete');
Route::get('api/:ver/upvote/:id', 'api/:ver.upvote/read');

//评论
Route::post('api/:ver/comment', 'api/:ver.comment/save');
Route::get('api/:ver/comment/:id', 'api/:ver.comment/read');

//社区发布图片的方式
Route::post('api/:ver/uploadImageType', 'api/:ver.socialImage/uploadImageType');
//直接传到图片到服务器，服务器传七牛
Route::post('api/:ver/localUploadImage', 'api/:ver.socialImage/localUploadImage');
