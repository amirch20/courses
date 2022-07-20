<?php

namespace App\Http\Controllers\api\add_homework;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\text_homework;
class textcontroller extends Controller
{
    public function text_homework_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = text_homework::find($request->id);
                $data->add_homeworks_id =$request->add_homeworks_id ??$data->add_homeworks_id ;
                $data->add_question_text=$request->add_question_text??$data->add_question_text;
                $data->question_type=$request->question_type??$data->question_type;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'add_homeworks_id' => 'required',
                    'add_question_text' => 'required',
                    'question_type' => 'required',

                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new text_homework;
                $data->add_homeworks_id=$request->add_homeworks_id;
                $data->add_question_text=$request->add_question_text;
                $data->question_type=$request->question_type;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'text_homework is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'text_homework is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function text_homework_show()
    {
        try {
            $data = text_homework::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'text_homework show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function text_homework_delete(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = text_homework::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'text_homework delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
