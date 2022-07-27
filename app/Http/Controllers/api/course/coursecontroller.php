<?php

namespace App\Http\Controllers\api\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Course;
use URL;
use Illuminate\Support\Facades\Storage;
class coursecontroller extends Controller
{
    public function course_create(Request $request)
    {
        if($request->id)
        {
        $data = Course::find($request->id);
        $data->course_title = $request->course_title??$data->course_title;
        $data->instructor = $request->instructor??$data->instructor;
        $data->short_description = $request->short_description??$data->short_description;
        $data->description = $request->description??$data->description;
        $data->level = $request->level??$data->level;
        $data->requirements = $request->requirements??$data->requirements;
        $data->outcomes = $request->outcomes??$data->outcomes;
        $data->price = $request->price??$data->price;
        $data->course_privacy = $request->course_privacy??$data->course_privacy;
        $image = $request->file('thumbnail')->store('public/images');
        $filename = $request->file('thumbnail')->hashName();
        $pic = ('storage/images/'.$imageName1);
        $data->subjects_id = $request->subjects_id??$data->subjects_id;
        $query = $data->save();
        }
        else
        {
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
            'subjects_id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        $data = new Course;
        $data->course_title = $request->course_title;
        $data->category_id = $request->category_id;
        $data->instructor = $request->instructor;
        $data->short_description = $request->short_description;
        $data->description = $request->description;
        $data->level = $request->level;
        $data->languages_id = $request->languages_id;
        $data->requirements = $request->requirements;
        $data->outcomes = $request->outcomes;
        $data->price = $request->price;
        $data->course_privacy = $request->course_privacy;
        $imageName1 = time().'.'.$request->thumbnail->getClientOriginalName();
        $request->thumbnail->move(public_path('images'),$imageName1);
        $data->thumbnail=$imageName1;
        $data->subjects_id = $request->subjects_id;
        $query=$data->save();
        }
        if($query)
        {
            $result =[
                'success' =>true,
                'messaage'=>'course is save successfully',
                ];
        }
        else
        {
            $result = [
                'success'=>false,
                'message'=>'course is not successfully',
                ];
        }
        return response()->json($result);
    }
    public function course_list()
    {
        try {
            $data = Course::join('categories','categories.id', '=', 'courses.category_id')
        ->select('categories.category_name','courses.course_title','courses.instructor','courses.price','courses.course_privacy','courses.sales','courses.lession')
        ->get();
       return response()->json(['success'=>true,'data'=>$data,'message'=>'course list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
        
       
    }
    public function course_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        else{
        try {
            $data = Course::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'course has deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    }
}
