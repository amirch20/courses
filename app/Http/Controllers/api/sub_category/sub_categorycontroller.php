<?php

namespace App\Http\Controllers\api\sub_category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Sub_Category;
class sub_categorycontroller extends Controller
{
    public function sub_category_store(Request $request)
    {
        try {
            if($request->id)
            {
                $cat = Sub_Category::find($request->id);
                $cat->name = $request->name??$cat->name;
                $cat->main__categories_id= $request->main__categories_id??$cat->main__categories_id;
                $cat->sub_category = $request->sub_category??$cat->sub_category;
                $query = $cat->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'main__categories_id' => 'required',
                    'sub_category' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new Sub_Category;
                $cat->name = $request->name;
                $cat->main__categories_id  = $request->main__categories_id;
                $cat->sub_category = $request->sub_category;
                $query = $cat->save();
            }
                    if($query)
                    {
                      $return = [
                        'success' => 'true',
                        'message' => 'Sub_Category is save successfully',

                      ];
                    }
                    else
                    {
                      $return = [
                        'success' => false,
                        'message' => 'Sub_Category is not save successfully',
                    ];
                    }
                    return response()->json($return);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
        }
        
    public function sub_category_list()
    {
        try {
            $data = Sub_Category::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'sub_category show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function sub_category_delete(Request $request)
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
                $data = Sub_Category::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'sub_category delete succesfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th]);
            }
        }
    }
}
