<?php

namespace App\Http\Controllers\api\forgot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Hash;
use Carbon\Carbon;
use App\Models\password_reset;
use App\Models\Admin;
use App\Mail\Mail;
use Illuminate\Support\Facades\{DB,Validator};
class forgotpasswordcontroller extends Controller
{
    public function admin_forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        $email=Admin::where('email', $request->email)->first();
                    if($email)
                    {
                        $password=password_reset::create([
                        'email'=>$request->email,
                        'token'=> Str::random(60),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        ]);

                        $tokenData=password_reset::where('email', $request->email)->first();
                        $token=$tokenData->token;
                        // return $token;
                        \Mail::to($request->email)->send(new \App\Mail\Mail($token));
                        return response()->json(['success'=>true,'message'=>'check your email']);
                    }
    }
    public function reset_admin_password(Request $request,$token)
    {
        // return $request;
        // $rules = [
        //     'password'   => 'required',
        //     'confirm_password'=>'required'

        // ];

        // $validate = Validator::make($request->all(), $rules);
        // if($validate->fails())
        // {
        //     //  $response['data']['error'] = $validate->messages();
        //      return response()->json(['message'=>$validate->messages()]);
        // }
        $email=password_reset::where('token', $token)->first();
                    // return $email->email;
                    if($email->email)
                    {
                        $user=Admin::where('email', $email->email)->update([

                            'password' => Hash::make($request->password),
                            'confirm_password' => $request->confirm_password
                        ]);
                    }


                    if($email)
                    {
                        DB::commit();
                        return response()->json(['message'=>'Password reset sucessfully']);
                        // $response['data']['code']= 200;
                        // $response['data']['message'] = "Congratulation your password change successfully";
                        // $response['data']['result'] = $email;
                    }
    }
}
