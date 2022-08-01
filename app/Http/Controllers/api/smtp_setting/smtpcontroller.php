<?php

namespace App\Http\Controllers\api\smtp_setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Smtp_Setting;
class smtpcontroller extends Controller
{
    public function smtp_setting_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Smtp_Setting::find($request->id);
                $data->protocol=$request->protocol??$data->protocol;
                $data->smtp_host=$request->smtp_host??$data->smtp_host;
                $data->smtp_port=$request->smtp_port??$data->smtp_port;
                $data->smtp_username=$request->smtp_username??$data->smtp_username;
                $data->smtp_password=$request->smtp_password??$data->smtp_password;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'protocol' => 'required',
                    'smtp_host' => 'required',
                    'smtp_port' => 'required',
                    'smtp_username' => 'required',
                    'smtp_password' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data=new Smtp_Setting;
                $data->protocol=$request->protocol;
                $data->smtp_host=$request->smtp_host;
                $data->smtp_port=$request->smtp_port;
                $data->smtp_username=$request->smtp_username;
                $data->smtp_password=$request->smtp_password;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'smtp_settings store successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'smtp_settings is not save successfully',
                ];
            }
            return response()->json([$result]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function smtp_setting_list()
    {
        try {
            $data = smtp_setting::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'smtp_setting show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function smtp_setting_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = smtp_setting::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'smtp_setting delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }

    public function smtp_setting_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = smtp_setting::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
