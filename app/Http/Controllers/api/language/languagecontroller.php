<?php

namespace App\Http\Controllers\api\language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\language;
class languagecontroller extends Controller
{
    public function language_create(Request $request)
    {
        try {
            if($request->id)
            {
                $data = language::find($request->id);
                $data->language_name= $request->language_name??$data->language_name;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'language_name' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new language;
                $cat->language_name = $request->language_name;
                $query = $cat->save();
            }
                    if($query)
                    {
                      $return = [
                        'success' => true,
                        'message' => 'language is save successfully',

                      ];
                    }
                    else
                    {
                      $return = [
                        'success' => false,
                        'message' => 'language is not save successfully',
                    ];
                    }
                    return response()->json($return);
        } catch (\Throwable $th) {
            return  response()->json(['message'=>$th->getmessage()]);
        }
        }


    public function language_list()
    {
        try {
            $data = language::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'language list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function language_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }else{
            try {
                $data = language::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'language delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }
}
