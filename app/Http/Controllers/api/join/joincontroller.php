<?php

namespace App\Http\Controllers\api\join;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Module;
use App\Models\Lession;
use Illuminate\Support\Facades\{DB,Validator};
class joincontroller extends Controller
{
    public function subject_join(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'courses_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Subject::where('courses_id',$request->courses_id)
            ->join('courses', 'subjects.courses_id', '=', 'courses.id')
            ->select('subjects.subject_name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'subjects name show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function module_join(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'subjects_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data =Module::where('subjects_id',$request->subjects_id)
            ->join('subjects','subjects.id', '=', 'modules.subjects_id')
            ->select('modules.module_name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'module name show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function lession_join(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'modules_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lession::where('modules_id',$request->modules_id)
            ->join('modules','modules.id', '=', 'lessions.modules_id')
            ->select('lessions.lession_name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'lession show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function lecture_join(Request $request)
    {
        $lecture = DB::table('lessions')
        ->join('course__videos','course__videos.lessions_id','=','lessions.id')
        ->join('videos','videos.lessions_id','=','lessions.id')
        ->join('lecture_audios','lecture_audios.lessions_id','=','lessions.id')
        ->join('lecture__documents','lecture__documents.lessions_id','=','lessions.id')
        ->join('lecture__images','lecture__images.lessions_id','=','lessions.id')
        ->join('lecture__other__videos','lecture__other__videos.lessions_id','=','lessions.id')
        ->join('lecture__texts','lecture__texts.lessions_id','=','lessions.id')
        ->select('course__videos.video_url','videos.video_file','lecture_audios.id','lecture__documents.document_file','lecture__images.image_title','lecture__other__videos.video_description','lecture__texts.text')
        ->get();
        return $lecture;
    }
}
