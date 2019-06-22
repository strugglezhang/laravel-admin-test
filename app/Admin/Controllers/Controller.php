<?php


    namespace App\Admin\Controllers;


    use Encore\Admin\Controllers\AdminController;
    use Illuminate\Support\Facades\Auth;

    class Controller extends AdminController
    {
        protected function userInfo()
        {
            return (Auth::guard('admin')->user()->toArray());
        }
    }