<?php

namespace App\Http\Controllers\api\system_settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System_settings;
use Illuminate\Support\Facades\{DB,Validator};
class system_setting extends Controller
{
    public function system_setting_create(Request $request)
    {
        try {
            if($request->id)
            {
                $cat = System_settings::find($request->id);
                $cat->site_name = $request->site_name?? $cat->site_name;
                $cat->site_title = $request->site_title?? $cat->site_title;
                $cat->site_keyword = $request->site_keyword?? $cat->site_keyword;
                $cat->description = $request->description?? $cat->description;
                $cat->author = $request->author?? $cat->author;
                $cat->slogan = $request->slogan?? $cat->slogan;
                $cat->system_email = $request->system_email?? $cat->system_email;
                $cat->phone = $request->phone?? $cat->phone;
                $cat->address = $request->address?? $cat->address;
                $query = $cat->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'site_name' => 'required',
                    'site_title' => 'required',
                    'site_keyword' => 'required',
                    'description' => 'required',
                    'author' => 'required',
                    'slogan' => 'required',
                    'system_email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $cat = new System_settings;
                $cat->site_name = $request->site_name;
                $cat->site_title = $request->site_title;
                $cat->site_keyword = $request->site_keyword;
                $cat->description = $request->description;
                $cat->author = $request->author;
                $cat->slogan = $request->slogan;
                $cat->system_email = $request->system_email;
                $cat->phone = $request->phone;
                $cat->address = $request->address;
                $query = $cat->save();
            }
                if($query)
                {
                  $return = [
                    'success' => true,
                    'message' => 'system is save successfully',

                  ];
                }
                else
                {
                  $return = [
                    'success' => false,
                    'message' => 'system is not save successfully',
                ];
                }
                return response()->json($return);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

    }

    public function system_setting_list()
    {
        try {
            $data = System_settings::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'system setting list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function system_setting_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        else{
            try {
                $data = System_settings::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'system_setting recorde delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function system_setting_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = System_settings::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    
}
