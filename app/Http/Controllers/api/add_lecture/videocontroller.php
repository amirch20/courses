<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Video;
class videocontroller extends Controller
{
    public function video_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Video::find($request->id);
                $data->video_title = $request->video_title??$data->video_title;
                $data->video_description = $request->video_description??$data->video_description;
                $imageName = time().'.'.$request->video_file->getClientOriginalExtension();
                $request->video_file->move(public_path('images'),$imageName);
                $data->video_file=$imageName??$data->video_file;
                $query = $data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'video_title' => 'required',
                    'video_description' => 'required',
                    'video_file' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Video;
                $data->video_title = $request->video_title;
                $data->video_description = $request->video_description;
                $imageName = time().'.'.$request->video_file->getClientOriginalExtension();
                $request->video_file->move(public_path('images'),$imageName);
                $data->video_file=$imageName;
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Video is save successfully',
                ];
            }
            else{
                $result = [
                    'success'=>false,
                    'message'=>'Video is not save successfully',
                ];
            }
            return response()->json(['message'=>$result]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function video_show()
    {
        try {
            $data = Video::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Video show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function video_delete(Request $request)
    {
        try {

                $validator = Validator::make($request->all(), [
                    'id' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = Video::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'video delete successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }
}
