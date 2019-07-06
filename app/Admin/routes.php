<?php

    use Illuminate\Routing\Router;


    Admin::routes();

    Route::group([
        'prefix' => config('admin.route.prefix'),
        'namespace' => config('admin.route.namespace'),
        'middleware' => config('admin.route.middleware'),
    ], function (Router $router) {
        // 首页
        $router->get('/', 'HomeController@index');
        $router->resource('companies', CompanyController::class);
        $router->resource('products', ProductController::class);
        $router->resource('achieves', AchieveController::class);
        $router->resource('customers', CustomerController::class);
        $router->resource('users', UsersController::class);
    });


