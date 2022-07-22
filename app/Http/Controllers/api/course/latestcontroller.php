<?php

namespace App\Http\Controllers\api\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Course;
class latestcontroller extends Controller
{
    public function latest_course_list()
    {
        try {
           $data = Course::latest()->take(10)->get();
           return response()->json(['success'=>true,'data'=>$data,'message'=>'latest course show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
