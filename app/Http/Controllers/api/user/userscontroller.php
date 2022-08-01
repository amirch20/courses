<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\User;
use Hash;
use Auth;
class userscontroller extends Controller
{
    public function user_insert(Request $request)
    {
        try {
            if($request->id)
        {
            $cat = User::find($request->id);
            $cat->role_id = $request->role_id?? $cat->role_id;
            $cat->user_name = $request->user_name?? $cat->user_name;
            $cat->email = $request->email?? $cat->email;
            $cat->password = $request->password?? $cat->password;
            $cat->confirm_password = $request->confirm_password?? $cat->confirm_password;
            $cat->gender = $request->gender?? $cat->gender;
            $cat->status="active";
            $query = $cat->save();
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'role_id' => 'required',
                'user_name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'confirm_password' => 'required',
                'gender' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $cat = new User;
            $cat->role_id = $request->role_id;
            $cat->user_name = $request->user_name;
            $cat->email = $request->email;
            $cat->password = Hash::make($request->password);
            $cat->confirm_password = $request->confirm_password;
            $cat->gender = $request->gender;
            $cat->status="active";
            $query = $cat->save();
        }
                if($query)
                {
                  $return = [
                    'success' => true,
                    'message' => 'User is save successfully',
                  ];
                }
                else
                {
                  $return = [
                    'success' => false,
                    'message' => 'User is not save successfully',
                ];
                }
                return response()->json($return);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }

        }

    public function user_list()
    {
        try {
            $data = DB::table('users')
            ->join('roles','users.role_id','=','roles.id')
            ->select('users.id','users.user_name','users.email','users.gender','users.status','roles.role_name')
            ->get();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'user list show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function user_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }else{
            try {
                $data = User::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'user delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function user_login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $authUser = Auth::user();
                $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
                return response()->json(['success'=>true,'token'=>$success,'user'=> $authUser ,'message'=>'user loggin successfully']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function user_logout(Request $request)
    {
        // return "hy";
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['success'=>true,'message'=>'user logout successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function user_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
           $data=DB::table('users')
             ->select('id', 'user_name', 'email', 'gender','role_id')
             ->where('id','=', $request->id)
             ->first();

            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
