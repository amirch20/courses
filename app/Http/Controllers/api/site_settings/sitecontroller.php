<?php

namespace App\Http\Controllers\api\site_settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Site_Setting;
class sitecontroller extends Controller
{
    public function site_setting_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Site_Setting::find($request->id);
                $data->banner_title=$request->banner_title??$data->banner_title;
                $data->banner_sub_title=$request->banner_sub_title??$data->banner_sub_title;
                $data->cookie_status=$request->cookie_status??$data->cookie_status;
                $data->cookie_note=$request->cookie_note??$data->cookie_note;
                $data->cookie_policy=$request->cookie_policy??$data->cookie_policy;
                $data->about_us=$request->about_us??$data->about_us;
                $data->term_and_condition=$request->term_and_condition??$data->term_and_condition;
                $data->privacy_policy=$request->privacy_policy??$data->privacy_policy;
                $imageName1 = time().'.'.$request->banner_images->getClientOriginalName();
                $request->banner_images->move(public_path('images'),$imageName1);
                $data->banner_images=$imageName1??$data->banner_images;
                $imageName2 = time().'.'.$request->small_logo->getClientOriginalExtension();
                $request->small_logo->move(public_path('images'),$imageName2);
                $data->small_logo=$imageName2??$data->small_logo;
                $imageName3 = time().'.'.$request->orignal_logo->getClientOriginalName();
                $request->orignal_logo->move(public_path('images'),$imageName3);
                $data->orignal_logo=$imageName3??$data->orignal_logo;
                $imageName4 = time().'.'.$request->favicon->getClientOriginalExtension();
                $request->favicon->move(public_path('images'),$imageName4);
                $data->favicon=$imageName4??$data->favicon;
                $query = $data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'banner_title' => 'required',
                    'banner_sub_title' => 'required',
                    'cookie_status' => 'required',
                    'cookie_note' => 'required',
                    'cookie_policy' => 'required',
                    'about_us' => 'required',
                    'term_and_condition' => 'required',
                    'privacy_policy' => 'required',
                    'banner_images' => 'required',
                    'small_logo' => 'required',
                    'orignal_logo' => 'required',
                    'favicon' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Site_Setting;
                $data->banner_title = $request->banner_title;
                $data->banner_sub_title = $request->banner_sub_title;
                $data->cookie_status = $request->cookie_status;
                $data->cookie_note = $request->cookie_note;
                $data->cookie_policy = $request->cookie_policy;
                $data->about_us = $request->about_us;
                $data->term_and_condition = $request->term_and_condition;
                $data->privacy_policy = $request->privacy_policy;
                $imageName1 = time().'.'.$request->banner_images->getClientOriginalName();
                $request->banner_images->move(public_path('images'),$imageName1);
                $data->banner_images=$imageName1;
                $imageName2 = time().'.'.$request->small_logo->getClientOriginalExtension();
                $request->small_logo->move(public_path('images'),$imageName2);
                $data->small_logo=$imageName2;
                $imageName3 = time().'.'.$request->orignal_logo->getClientOriginalName();
                $request->orignal_logo->move(public_path('images'),$imageName3);
                $data->orignal_logo=$imageName3;
                $imageName4 = time().'.'.$request->favicon->getClientOriginalExtension();
                $request->favicon->move(public_path('images'),$imageName4);
                $data->favicon=$imageName4;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'site setting store successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'site setting is not store successfully',
                ];
            }
            return response()->json($result);

        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function site_setting_list()
    {
        try {
            $data = Site_Setting::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Site_Setting show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function site_setting_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Site_Setting::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Site_Setting delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
