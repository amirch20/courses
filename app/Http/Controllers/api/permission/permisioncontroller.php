<?php

namespace App\Http\Controllers\api\permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Permission;
class permisioncontroller extends Controller
{
    public function permission_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Permission::find($request->id);
                $data->category_id=$request->category_id??$data->category_id;
                $data->name=$request->name??$data->name;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Permission;
                $data->category_id=$request->category_id;
                $data->name=$request->name;
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'permission store successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'permission is not store successfully',
                ];
            }
            return response()->json([$result]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage]);
        }
    }

    public function permission_list()
    {
        try {
            $data = permission::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'permission show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function permission_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = permission::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'permission delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
