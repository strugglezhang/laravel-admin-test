<?php

    namespace App\Http\Controllers;


    use App\Models\AdminRoles;
    use Illuminate\Http\Request;

    class ajaxDataController extends Controller
    {
        public function getSuperior(Request $request)
        {
            $roleId = $request->input('q', null);
            if (empty($roleId)) {
                return [];
            }

            if ($roleId == 5) {
                $userModel = config('admin.database.users_model');
                $data = $userModel::all()->pluck('name', 'id');
                unset($data[1]);
                $res = [];
                if(!empty($data)){
                    foreach($data as $k => $v){
                        $res[] = [
                            'id' => $k,
                            'text   ' => $v
                        ];
                    }
                }
                return $res;
            }
            return [];

        }
    }