<?php

namespace App\Http\Controllers\api\inner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Module;
use Illuminate\Support\Facades\{DB,Validator};
class innercontroller extends Controller
{
    public function inner_join(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'course_title' => 'required',
                'category_id' =>'required',
                'instructor' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'level' => 'required',
                'languages_id' => 'required',
                'requirements' => 'required',
                'outcomes' => 'required',
                'price' => 'required',
                'course_privacy' => 'required',
                'thumbnail' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $course = new Course;
            $course->course_title = $request->course_title;
            $course->category_id = $request->category_id;
            $course->instructor = $request->instructor;
            $course->short_description = $request->short_description;
            $course->description = $request->description;
            $course->level = $request->level;
            $course->languages_id = $request->languages_id;
            $course->requirements = $request->requirements;
            $course->outcomes = $request->outcomes;
            $course->price = $request->price;
            $course->course_privacy = $request->course_privacy;
            $imageName1 = time().'.'.$request->thumbnail->getClientOriginalName();
            $request->thumbnail->move(public_path('images'),$imageName1);
            $course->thumbnail=$imageName1;
            $course->save();
            if($course->save())
            {
                $validator = Validator::make($request->all(), [
                    'subject_name' => 'required',
                    'teachers_id' => 'required',
                    'modules_id' => 'required',
                    'courses_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Subject;
                $data->subject_name = $request->subject_name;
                $data->teachers_id = $request->teachers_id;
                $data->modules_id = $request->modules_id;
                $data->courses_id = $request->courses_id;
                $data->save();
                if($data->save())

            {
                DB::commit();
                $response['data']['code']       = 200;
                $response['data']['message']    = 'data store successfully';
            }
            else
            {
                DB::rollBack();
            }
            return response()->json(['success'=>true,'message'=>'data store successfully']);
        }
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function course_join(Request $request)
    {
        try {
          
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}

