<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lecture_Text;
class textcontroller extends Controller
{
    public function text_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lecture_Text::find($request->id);
                $data->title=$request->title??$data->title;
                $data->text=$request->text??$data->text;
                $data->lecture_type="text";
                $data->lessions_id=$request->lessions_id??$data->lessions_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'text' => 'required',
                    'lessions_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lecture_Text;
                $data->title=$request->title;
                $data->text=$request->text;
                $data->lecture_type="text";
                $data->lessions_id=$request->lessions_id??$data->lessions_id;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Lecture_Text is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Lecture_Text is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }

    public function text_show()
    {
        try {
            $data = Lecture_Text::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Lecture_Text show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function text_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Text::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Lecture_Text delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function text_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Text::where('id',$request->id)->first();
            return response()->json(['message'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
