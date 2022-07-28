<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lecture_Image;
class imagecontroller extends Controller
{
    public function image_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lecture_Image::find($request->id);
                $data->image_title=$request->image_title??$data->image_title;
                $data->image_description=$request->image_description??$data->image_description;
                $imageName = time().'.'.$request->image_file->getClientOriginalExtension();
                $request->image_file->move(public_path('images'),$imageName);
                $data->image_file=$imageName??$data->image_file;
                $data->lecture_type='image';
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'image_title' => 'required',
                    'image_description' => 'required',
                    'image_file' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lecture_Image;
                $data->image_title = $request->image_title;
                $data->image_description = $request->image_description;
                $imageName = time().'.'.$request->image_file->getClientOriginalExtension();
                $request->image_file->move(public_path('images'),$imageName);
                $data->image_file=$imageName;
                $data->lecture_type='image';
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Lecture_Image is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Lecture_Image is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function image_show()
    {
        try {
            $data = Lecture_Image::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Lecture_Image show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function image_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Image::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Lecture_Image delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
