<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['namespace'=>'v1','prefix'=>'/api/v1'], function () use ($router) {
    //登录列表
    $router->post('/login','LoginController@login');
    //首页数据
    $router->get('/','IndexController@index');
    //点击次数增加
    $router->post('/click/number/increment','IndexController@addClickNumber');
    //推荐列表，添加喜欢收藏
    $router->post('/recommend/favorite','IndexController@addFavorite');
    //高校列表
    $router->get('/school/list', 'SchoolController@getSchoolList');
    //社团列表
    $router->get('/club/list', 'ClubController@getClubList');
    //社团最新活动
    $router->get('/club/activity/new', 'ClubActivityController@getClubNewActivity');
    //班级列表
    $router->get('/class/list', 'SchoolClassController@getSchoolClassList');
});