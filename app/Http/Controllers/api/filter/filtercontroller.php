<?php

namespace App\Http\Controllers\api\filter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Course;
use App\Models\User;
use App\Models\Main_Category;
use App\Models\Sub_Category;
use App\Models\Child_Category;
use App\Models\Subject;
use App\Models\Module;
use App\Models\Lession;
class filtercontroller extends Controller
{
    public function course_filter(Request $request)
    {
        // return "hy";
        try {
            $data = Course::where('course_title', 'LIKE', '%'. $request->course_title. '%')
            ->where('course_privacy', 'LIKE', '%'. $request->course_privacy. '%')
            ->where('category_id', 'LIKE', '%'. $request->category_id. '%')
            ->where('instructor', 'LIKE', '%'. $request->instructor. '%')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'course data show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'message'=>$th->getmessage()]);
        }
    }

    public function user_filter(Request $request)
    {
        // return "hy";
        try {
            $data = User::where('user_name', 'LIKE', '%'. $request->user_name. '%')
            ->where('email', 'LIKE', '%'. $request->email. '%')
            ->Where('role', 'LIKE', '%'.$request->role.'%')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'user data show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function main_category_filter(Request $request)
    {
        try {
            $data = Main_Category::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function sub_category_filter(Request $request)
    {
        try {
            $data = Sub_Category::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function child_category_filter(Request $request)
    {
        try {
            $data = Child_Category::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function subject_filter(Request $request)
    {
        try {
            $data = Subject::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function modules_filter(Request $request)
    {
        try {
            $data = Module::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function lession_filter(Request $request)
    {
        try {
            $data = Lession::where('name', 'LIKE', '%'. $request->name. '%')->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function course_type_filter(Request $request)
    {
        if($request->price==0)
        {
            $data = Course::where('price', 'LIKE', '%'. $request->price. '%')->get();
            return $data;
        }

    }
}
