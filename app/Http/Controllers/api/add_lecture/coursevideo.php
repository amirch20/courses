<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Course_Video;
class coursevideo extends Controller
{
    public function course_video_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Course_Video::find($request->id);
                $data->video_title = $request->video_title??$data->video_title;
                $data->video_description = $request->video_description??$data->video_description;
                $data->video_url = $request->video_url??$data->video_url;
                $data->lessions_id = $request->lessions_id??$data->lessions_id;
                $data->lecture_type = 'lecture_video';
                $query = $data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'video_title' => 'required',
                    'video_description' => 'required',
                    'video_url' => 'required',
                    'lessions_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Course_Video;
                $data->video_title = $request->video_title;
                $data->video_description = $request->video_description;
                $data->video_url = $request->video_url;
                $data->lessions_id = $request->lessions_id;
                $data->lecture_type = 'lecture_video';
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Course_Video is save successfully',
                ];
            }
            else{
                $result = [
                    'success'=>false,
                    'message'=>'Course_Video is not save successfully',
                ];
            }
            return response()->json(['message'=>$result]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function course_video_show()
    {
        try {
            $data = Course_Video::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'course_video show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function course_video_delete(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Course_Video::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'course_video delete successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function course_video_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        $data = Course_Video::where('id',$request->id)->first();
        return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
