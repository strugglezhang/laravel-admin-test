<?php

use Encore\Admin\Controllers\AuthController;
use Illuminate\Routing\Router;


// Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    // 首页
    $router->get('/', 'HomeController@index');

    // 分公司管理
    $router->get('/company/index', 'CompanyController@index');

    // 业绩管理
    $router->get('/achiev/index', 'AchievController@index');

    // 用户管理
    $router->get('/user/index', 'UserController@index');

    // 产品管理
    $router->get('/product/index', 'ProductController@index');

    // 数据统计
    $router->get('/statistics/index', 'StatisticsController@index');

    /* @var \Illuminate\Support\Facades\Route $router */
    $router->namespace('\Encore\Admin\Controllers')->group(function ($router) {
        /* @var \Illuminate\Routing\Router $router */
        $router->resource('auth/users', 'UserController')->names('admin.auth.users');
        $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
        $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
        $router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('admin.auth.menu');
        $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');
        $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
    });

});
