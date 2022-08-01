<?php

namespace App\Http\Controllers\api\add_homework;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Video_homework;
class videocontroller extends Controller
{
    public function video_homework_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Video_homework::find($request->id);
                $data->add_homeworks_id=$request->add_homeworks_id??$data->add_homeworks_id;
                $data->video_title=$request->video_title??$data->video_title;
                $data->video_description=$request->video_description??$data->video_description;
                $imageName = time().'.'.$request->video_file->getClientOriginalExtension();
                $request->video_file->move(public_path('images'),$imageName);
                $data->video_file=$imageName??$data->video_file;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'add_homeworks_id' => 'required',
                    'video_title' => 'required',
                    'video_description' => 'required',
                    'video_file' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Video_homework;
                $data->add_homeworks_id = $request->add_homeworks_id;
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
                    'message'=>'Video_homework is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Video_homework is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function video_homework_show()
    {
        try {
            $data = Video_homework::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Video_homework show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function video_homework_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Video_homework::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Video_homework delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function video_homework_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Video_homework::where('id',$request->id)->first();
            return response()->json(['message'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
