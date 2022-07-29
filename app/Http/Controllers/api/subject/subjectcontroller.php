<?php

namespace App\Http\Controllers\api\subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Subject;
class subjectcontroller extends Controller
{
    public function subject_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Subject::find($request->id);
                $data->name = $request->name?? $data->name;
                $data->teachers_id = $request->teachers_id?? $data->teachers_id;
                $data->modules_id = $request->modules_id?? $data->modules_id;
                $data->courses_id = $request->courses_id??$data->courses_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'teachers_id' => 'required',
                    'modules_id' => 'required',
                    'courses_id'=>'required'
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Subject;
                $data->name = $request->name;
                $data->teachers_id = $request->teachers_id;
                $data->modules_id = $request->modules_id;
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
        $validator = Validator::make($request->all(), [
            'courses_id' =>'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        try {
            $data= Subject::where('courses_id',$request->courses_id)
            ->join('courses','subjects.courses_id','=','courses.id')
            ->join('teachers','subjects.teachers_id','=','teachers.id')
            ->join('modules','subjects.modules_id','=','modules.id')
            ->join('lessions','modules.lessions_id','=','lessions.id')
            ->select('subjects.id','subjects.name','teachers.teacher_name')
            ->get();
            $count = $data[0]->id;
            $module = count(array($count));
            $num = $data[0]->created_at;
            $lession = count(array($num));
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
}
