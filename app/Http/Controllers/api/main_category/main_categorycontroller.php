<?php

namespace App\Http\Controllers\api\main_category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Main_Category;
class main_categorycontroller extends Controller
{
    public function main_category_store(Request $request)
    {
        if($request->id)
        {
            $cat = Main_Category::find($request->id);
            $cat->name = $request->name??$cat->name;
            $cat->description = $request->description??$cat->description;
            $cat->main_category = $request->main_category??$cat->main_category;
            $imageName = time().'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('images'),$imageName);
            $cat->thumbnail=$imageName??$data->thumbnail;
            $query = $cat->save();
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'main_category' => 'required',
                'thumbnail' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $cat = new Main_Category;
            $cat->name = $request->name;
            $cat->description = $request->description;
            $cat->main_category = $request->main_category;
            $imageName = time().'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('images'),$imageName);
            $cat->thumbnail=$imageName;
            $query = $cat->save();
        }
                if($query)
                {
                  $return = [
                    'success' => 'true',
                    'message' => 'Main_Category is save successfully',

                  ];
                }
                else
                {
                  $return = [
                    'success' => false,
                    'message' => 'Main_Category is not save successfully',
                ];
                }
                return response()->json($return);
        }

    public function main_category_list()
    {
        try {
            $data = Main_Category::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'main_category show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function main_category_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }else{
        try {
            $data = Main_Category::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'main category delete successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    }
}
