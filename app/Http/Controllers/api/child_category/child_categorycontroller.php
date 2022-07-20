<?php

namespace App\Http\Controllers\api\child_category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Child_Category;
class child_categorycontroller extends Controller
{
    public function child_category_store(Request $request)
    {
        try {
            if($request->id)
            {    $data = Child_Category::find($request->id);
                $data->name = $request->name??$data->name;
                $data->main__categories_id = $request->main__categories_id??$data->main__categories_id;
                $data->sub__categories_id = $request->sub__categories_id??$data->sub__categories_id;
                $data->child_category = $request->child_category??$data->child_category;
                $query=$data->save();
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'main__categories_id' => 'required',
                    'sub__categories_id' => 'required',
                    'child_category' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new Child_Category;
                    $cat->name = $request->name;
                    $cat->main__categories_id  = $request->main__categories_id;
                    $cat->sub__categories_id= $request->sub__categories_id;
                    $cat->child_category = $request->child_category;
                    $query = $cat->save();
            }
                    if($query)
                    {
                      $return = [
                        'success' => true,
                        'message' => 'Child_Category is save successfully',

                      ];
                    }
                    else
                    {
                      $return = [
                        'success' => false,
                        'message' => 'Child_Category is not save successfully',
                    ];
                    }
                    return response()->json($return);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function child_category_list()
    {
        try {
            $data = Child_Category::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'child category show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function child_category_delete(Request $request)
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
                $data = Child_Category::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'child category delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }
}
