<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lecture_Other_Video;
class othercontroller extends Controller
{
    public function other_video_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lecture_Other_Video::find($request->id);
                $data->video_title=$request->video_title??$data->video_title;
                $data->video_description=$request->video_description??$data->video_description;
                $data->video_url=$request->video_url??$data->video_url;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'video_title' => 'required',
                    'video_description' => 'required',
                    'video_url' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lecture_Other_Video;
                $data->video_title=$request->video_title;
                $data->video_description=$request->video_description;
                $data->video_url=$request->video_url;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Lecture_Other_Video is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Lecture_Other_Video is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function other_video_show()
    {
        try {
            $data = Lecture_Other_Video::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Lecture_Other_Video show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function other_video_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Other_Video::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Lecture_Other_Video delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
