<?php

namespace App\Http\Controllers\api\main_category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Main_Category;
class topcategory extends Controller
{
    public function top_category_list(Request $request)
    {
        try {
            $data = Main_Category::all('name','thumbnail')->take(2);
            return response()->json(['success'=>true,'data'=>$data,'message'=>'top category list successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
