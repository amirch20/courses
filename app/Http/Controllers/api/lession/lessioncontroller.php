<?php

namespace App\Http\Controllers\api\lession;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lession;
class lessioncontroller extends Controller
{
    public function lession_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lession::find($request->id);
                $data->name = $request->name??$data->name;
                $data->courses_id=$request->courses_id??$data->courses_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'courses_id'=>'required'
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lession;
                $data->name = $request->name;
                $data->courses_id = $request->courses_id;
                $query=$data->save();
            }
                    if($query)
                    {
                        $result=[
                            'success'=>true,
                            'message'=>'lession is save successfully',
                        ];
                    }
                    else
                    {
                        $result=[
                            'success'=>false,
                            'message'=>'lession is not save',
                        ];
                    }
                    return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
        }

    public function lession_list(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'courses_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data =  DB::table('lessions')
            ->select('id','name')
            ->where('courses_id','=', $request->courses_id)
             ->first();
            $quiz = DB::table('lessions')
        ->join('add_assessments','lessions.id','=','add_assessments.lessions_id')
        ->select('add_assessments.quiz_title')
        ->count();
            $lecture = DB::table('lessions')
           ->join('course__videos','lessions.id','=','course__videos.lessions_id')
           ->join('videos','lessions.id','=','videos.lessions_id')
           ->join('lecture__documents','lessions.id','=','lecture__documents.lessions_id')
           ->join('lecture_audios','lessions.id','=','lecture_audios.lessions_id')
           ->join('lecture__images','lessions.id','=','lecture__images.lessions_id')
           ->join('lecture__other__videos','lessions.id','=','lecture__other__videos.lessions_id')
           ->join('lecture__texts','lessions.id','=','lecture__texts.lessions_id')
           ->select('course__videos.video_title','videos.id','lecture__documents.document_description','lecture_audios.audio_title','lecture__images.image_title','lecture__other__videos.video_url','lecture__texts.title')
           ->count();
            return response()->json(['success'=>true,'data'=>$data,'quiz'=>$quiz,'lecture'=>$lecture,'message'=>'lession show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function lession_delete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        else
        {
            try {
                $data = Lession::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'lession delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function lession_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lession::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>$th->getmessage()]);
        }
    }
}
