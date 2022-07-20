<?php

namespace App\Http\Controllers\api\add_homework;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\add_homework;
class homeworkcontroller extends Controller
{
    public function homework_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = add_homework::find($request->id);
                $data->name=$request->name??$data->name;
                $data->deadline=$request->deadline??$data->deadline;
                $data->lession_type=$request->lession_type??$data->lession_type;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'deadline' => 'required',
                    'lession_type' => 'required',

                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new add_homework;
                $data->name=$request->name;
                $data->deadline=$request->deadline;
                $data->lession_type=$request->lession_type;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'add_homework is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'add_homework is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function homework_show()
    {
        try {
            $data = add_homework::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'add_homework show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function homework_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = add_homework::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'add_homework delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
