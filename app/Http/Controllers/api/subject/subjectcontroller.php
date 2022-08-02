<?php

namespace App\Http\Controllers\api\subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Subject;
use App\Models\Module;
use App\Models\Lession;
class subjectcontroller extends Controller
{
    public function subject_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Subject::find($request->id);
                $data->subject_name = $request->subject_name?? $data->subject_name;
                $data->teachers_id = $request->teachers_id?? $data->teachers_id;
                $data->courses_id = $request->courses_id??$data->courses_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'subject_name' => 'required',
                    'teachers_id' => 'required',
                    'courses_id'=>'required'
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Subject;
                $data->subject_name = $request->subject_name;
                $data->teachers_id = $request->teachers_id;
                $data->courses_id = $request->courses_id;
                $query=$data->save();

            }
                    if($query)
                    {
                        $result=[
                            'success'=>true,
                            'message'=>'Subject is save successfully',
                        ];
                    }
                    else
                    {
                        $result=[
                            'success'=>false,
                            'message'=>'Subject is not save',
                        ];
                    }
                    return response()->json($result);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getmessage()]);
        }

        }


    public function subject_list(Request $request)
    {
        try {
            $data= Subject::where('courses_id',$request->courses_id)
            ->join('courses','subjects.courses_id','=','courses.id')
            ->join('teachers','subjects.teachers_id','=','teachers.id')
            ->select('subjects.id','subjects.subject_name','teachers.teacher_name')
            ->get();
            $module = DB::table('modules')
            ->join('subjects','modules.subjects_id','=','subjects.id')
            ->select('modules.module_name')
            ->count();
            $lession = DB::table('lessions')
            ->join('modules','lessions.modules_id','=','modules.id')
            ->select('lessions.lession_name')
            ->count();
            return response()->json(['success'=>true,'data'=>$data,'module'=>$module,'lession'=>$lession,'message'=>'subject show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function subject_delete(Request $request)
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
                $data = Subject::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'Subject delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function subject_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        $data = Subject::where('id',$request->id)->first();
        return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
        }

    }
}
