<?php

namespace App\Http\Controllers\api\join;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lession;
use Illuminate\Support\Facades\{DB,Validator};
class joincontroller extends Controller
{
    public function subject_join(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'subjects_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Course::where('courses.subjects_id',$request->subjects_id)
            ->join('subjects', 'subjects.id', '=', 'courses.subjects_id')
            ->select('subjects.name')
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
                'modules_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data =Module::where('subjects.modules_id',$request->modules_id)
            ->join('subjects','subjects.modules_id', '=', 'modules.id')
            ->select('modules.name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'module name show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage]);
        }
    }

    public function lession_join(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lessions_id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Module::where('modules.lessions_id',$request->lessions_id)
            ->join('lessions','lessions.id', '=', 'modules.lessions_id')
            ->select('lessions.name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'lession show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }
}
