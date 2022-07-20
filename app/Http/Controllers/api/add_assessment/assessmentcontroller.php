<?php

namespace App\Http\Controllers\api\add_assessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\add_assessment;
class assessmentcontroller extends Controller
{
    public function assessment_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = add_assessment::find($request->id);
                $data->quiz_title=$request->quiz_title??$data->quiz_title;
                $data->quiz_duration=$request->quiz_duration??$data->quiz_duration;
                $data->total_marks=$request->total_marks??$data->total_marks;
                $data->instrument=$request->instrument??$data->instrument;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'quiz_title' => 'required',
                    'quiz_duration' => 'required',
                    'total_marks' => 'required',
                    'instrument' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new add_assessment;
                $data->quiz_title=$request->quiz_title;
                $data->quiz_duration=$request->quiz_duration;
                $data->total_marks=$request->total_marks;
                $data->instrument=$request->instrument;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'add_assessment is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'add_assessment is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function assessment_show()
    {
        try {
            $data = add_assessment::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'add_assessment show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function assessment_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = add_assessment::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'add_assessment delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
