<?php

namespace App\Http\Controllers\api\lession;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lession;
use App\Models\Module;
class lessioncontroller extends Controller
{
    public function lession_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lession::find($request->id);
                $data->lession_name = $request->lession_name??$data->lession_name;
                $data->modules_id = $request->modules_id??$data->modules_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'lession_name' => 'required',
                    'modules_id' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lession;
                $data->lession_name = $request->lession_name;
                $data->modules_id = $request->modules_id;
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
            $lession = DB::table('lessions')
            ->join('modules','lessions.modules_id','=','modules.id')
            ->select('lessions.id','lessions.lession_name')
            ->get();
            $quiz = DB::table('add_assessments')
            ->join('lessions','add_assessments.lessions_id','=','lessions.id')
            ->select('add_assessments.quiz_title')
            ->count();
            $lecture = DB::table('lessions')
            ->join('course__videos','course__videos.lessions_id','=','lessions.id')
            ->join('videos','videos.lessions_id','=','lessions.id')
            ->join('lecture_audios','lecture_audios.lessions_id','=','lessions.id')
            ->join('lecture__documents','lecture__documents.lessions_id','=','lessions.id')
            ->join('lecture__images','lecture__images.lessions_id','=','lessions.id')
            ->join('lecture__other__videos','lecture__other__videos.lessions_id','=','lessions.id')
            ->join('lecture__texts','lecture__texts.lessions_id','=','lessions.id')
            ->select('course__videos.video_url','videos.video_file','lecture_audios.id','lecture__documents.document_file','lecture__images.image_title','lecture__other__videos.video_description','lecture__texts.text')
            ->count();


            return response()->json(['success'=>true,'lession'=>$lession,'quiz'=>$quiz,'lecture'=>$lecture,'message'=>'lession show successfully']);
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
