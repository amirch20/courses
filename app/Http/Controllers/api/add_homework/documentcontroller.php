<?php

namespace App\Http\Controllers\api\add_homework;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\document_homework;
class documentcontroller extends Controller
{
    public function document_homework_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = document_homework::find($request->id);
                $data->add_homeworks_id=$request->add_homeworks_id??$data->add_homeworks_id;
                $data->document_title=$request->document_title??$data->document_title;
                $data->document_description=$request->document_description??$data->document_description;
                $imageName = time().'.'.$request->document_file->getClientOriginalExtension();
                $request->document_file->move(public_path('images'),$imageName);
                $data->document_file=$imageName??$data->document_file;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'add_homeworks_id' => 'required',
                    'document_title' => 'required',
                    'document_description' => 'required',
                    'document_file' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new document_homework;
                $data->add_homeworks_id = $request->add_homeworks_id;
                $data->document_title = $request->document_title;
                $data->document_description = $request->document_description;
                $imageName = time().'.'.$request->document_file->getClientOriginalExtension();
                $request->document_file->move(public_path('images'),$imageName);
                $data->document_file=$imageName;
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'document_homework is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'document_homework is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function document_homework_show()
    {
        try {
            $data = document_homework::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'document_homework show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function document_homework_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = document_homework::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'document_homework delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function document_homework_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = document_homework::where('id',$request->id)->first();
            return response()->json(['message'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
