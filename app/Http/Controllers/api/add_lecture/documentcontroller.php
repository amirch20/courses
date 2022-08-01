<?php

namespace App\Http\Controllers\api\add_lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lecture_Document;
class documentcontroller extends Controller
{
    public function document_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lecture_Document::find($request->id);
                $data->document_title=$request->document_title??$data->document_title;
                $data->document_description=$request->document_description??$data->document_description;
                $imageName = time().'.'.$request->document_file->getClientOriginalExtension();
                $request->document_file->move(public_path('images'),$imageName);
                $data->document_file=$imageName??$data->document_file;
                $data->lecture_type="document";
                $data->lessions_id=$request->lessions_id??$data->lessions_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'document_title' => 'required',
                    'document_description' => 'required',
                    'document_file' => 'required',
                    'lessions_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lecture_Document;
                $data->document_title = $request->document_title;
                $data->document_description = $request->document_description;
                $imageName = time().'.'.$request->document_file->getClientOriginalExtension();
                $request->document_file->move(public_path('images'),$imageName);
                $data->document_file=$imageName;
                $data->lecture_type="document";
                $data->lessions_id=$request->lessions_id;
                $query = $data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Lecture_Document is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Lecture_Document is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }
    public function document_show()
    {
        try {
            $data = Lecture_Document::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Lecture_Document show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function document_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Document::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Lecture_Document delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function document_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lecture_Document::where('id',$request->id)->first();
            return response()->json(['message'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

}
