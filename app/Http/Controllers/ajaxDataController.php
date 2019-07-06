<?php

    namespace App\Http\Controllers;


    use Illuminate\Http\Request;

    class ajaxDataController extends Controller
    {
        public function getSuperior(Request $request)
        {
            $roleId = $request->input('q', null);

        }
    }