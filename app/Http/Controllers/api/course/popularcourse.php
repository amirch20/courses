<?php

namespace App\Http\Controllers\api\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Course;
class popularcourse extends Controller
{
    public function popular_course_list(Request $request)
    {
        try {
            $data = Course::all('course_title','instructor','price','thumbnail')->take(10);
            return response()->json(['success'=>true,'data'=>$data,'message'=>'popular course show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
