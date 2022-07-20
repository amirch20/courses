<?php

namespace App\Http\Controllers\api\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Teacher;
class teachercontroller extends Controller
{
    public function teacher_store(Request $request)
    {
        try {
            if($request->id)
        {
            $data = Teacher::find($request->id);
            $data->teacher_name = $request->teacher_name?? $data->teacher_name;
            $query=$data->save();
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'teacher_name' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = new Teacher;
            $data->teacher_name = $request->teacher_name;
            $query=$data->save();
        }
                if($query)
                {
                    $result=[
                        'success'=>true,
                        'message'=>'Teacher is save successfully',
                    ];
                }
                else
                {
                    $result=[
                        'success'=>false,
                        'message'=>'Teacher is not save',
                    ];
                }
                return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

        }


    public function teacher_list()
    {
        try {
            $data = Teacher::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Teacher show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function teacher_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        else
        {
            try {
                $data = Teacher::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'Teacher delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }
}
