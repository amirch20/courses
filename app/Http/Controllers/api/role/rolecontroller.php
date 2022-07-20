<?php

namespace App\Http\Controllers\api\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\{DB,Validator};
class rolecontroller extends Controller
{
    public function role_create(Request $request)
    {
        try {
            if($request->id)
            {
                $cat = Role::find($request->id);
                $cat->role_name = $request->role_name??$cat->role_name;
                $query = $cat->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'role_name' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new Role;
                $cat->role_name = $request->role_name;
                $query = $cat->save();
            }
                    if($query)
                    {
                      $return = [
                        'success' => 'true',
                        'message' => 'role is save successfully',

                      ];
                    }
                    else
                    {
                      $return = [
                        'success' => false,
                        'message' => 'role is not save successfully',
                    ];
                    }
                    return response()->json($return);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getmessage()]);
        }
        }
    public function role_list()
    {
        try {
            $data = Role::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'role list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function role_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }else{
            try {
                $data = Role::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'role delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }
}
