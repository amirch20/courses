<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lecture_audio;
class audiocontroller extends Controller
{
    public function audio_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lecture_audio::find($request->id);
                $data->audio_title=$request->audio_title??$data->audio_title;
                $data->audio_description=$request->audio_description??$data->audio_description;
                $imageName = time().'.'.$request->audio_file->getClientOriginalExtension();
                $request->audio_file->move(public_path('images'),$imageName);
                $data->audio_file=$imageName??$data->audio_file;
                $data->lecture_type="audio";
                $data->lessions_id = $request->lessions_id??$data->lessions_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'audio_title' => 'required',
                    'audio_description' => 'required',
                    'audio_file' => 'required',
                    'lessions_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lecture_audio;
                $data->audio_title = $request->audio_title;
                $data->audio_description = $request->audio_description;
                $imageName = time().'.'.$request->audio_file->getClientOriginalExtension();
                $request->audio_file->move(public_path('images'),$imageName);
                $data->audio_file=$imageName;
                $data->lecture_type="audio";
                $data->lessions_id=$request->lessions_id;
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Lecture_audio is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Lecture_audio is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }

    public function audio_show()
    {
        try {
            $data = Lecture_audio::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Lecture_audio show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function audio_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_audio::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Lecture_audio delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function audio_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_audio::where('id',$request->id)->first();
            return response()->json(['message'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
