<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Admin;
use Hash;
use Auth;
class admincontroller extends Controller
{
    public function admin_signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'surname' =>'required',
                'nationality' => 'required',
                'country' => 'required',
                'email' => 'required',
                'password' => 'required',
                'confirm_password' => 'required',
                'last_qualification' => 'required',
                'graduation_year' => 'required',
                'institution_name' => 'required',
                'qualification_country' => 'required',
                'upload_transcript' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'alternative_phone_number' => 'required',
                'address' => 'required',
                'current_address' => 'required',
                'additional_information' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = new Admin;
            $data->first_name = $request->first_name;
            $data->surname = $request->surname;
            $data->nationality = $request->nationality;
            $data->country = $request->country;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->confirm_password = $request->confirm_password;
            $data->last_qualification = $request->last_qualification;
            $data->graduation_year = $request->graduation_year;
            $data->institution_name = $request->institution_name;
            $data->qualification_country = $request->qualification_country;
            $imageName = time().'.'.$request->upload_transcript->getClientOriginalName();
            $request->upload_transcript->move(public_path('images'),$imageName);
            $data->upload_transcript=$imageName;
            $data->date_of_birth = $request->date_of_birth;
            $data->gender = $request->gender;
            $data->phone_number = $request->phone_number;
            $data->alternative_phone_number = $request->alternative_phone_number;
            $data->address = $request->address;
            $data->current_address = $request->current_address;
            $data->additional_information = $request->additional_information;
            $data->save();
            return response()->json(['success'=>true,'message'=>'Admin signup successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function admin_login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' =>'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (auth()->guard('admin')->attempt($data)) {
                $token = Auth::guard('admin')->user()->createToken('LaravelAuthApp')->accessToken;
                $data=Auth::guard('admin')->user();
               return response()->json(['success'=>'true','token'=>$token,'data'=>$data,'message'=>'Admin login successfully']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
    public function admin_logout(Request $request)
    {
        // return "hy";
        try {
            $data = auth()->guard('admin')->logout();
            return response()->json(['success'=>true,'message'=>'logout successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }


    }
}
