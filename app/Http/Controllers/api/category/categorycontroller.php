<?php

namespace App\Http\Controllers\api\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Category;
class categorycontroller extends Controller
{
    public function category_create(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Category::find($request->id);
                $data->category_name = $request->category_name;
                $query=$data->save();
            }else{
                $validator = Validator::make($request->all(), [
                    'category_name' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new Category;
                $cat->category_name = $request->category_name;
                $query = $cat->save();
            }
                    if($query)
                    {
                      $return = [
                        'success' => true,
                        'message' => 'Category is save successfully',

                      ];
                    }
                    else
                    {
                      $return = [
                        'success' => false,
                        'message' => 'Category is not save successfully',
                    ];
                    }
                    return response()->json($return);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function category_show()
    {
        try {
            $data = Category::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'category list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function category_delete(Request $request)
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
                $data = Category::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'category delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function category_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Category::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>$th->getmessage()]);
        }
    }
}
