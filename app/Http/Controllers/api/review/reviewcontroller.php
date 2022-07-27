<?php

namespace App\Http\Controllers\api\review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Review;
class reviewcontroller extends Controller
{
    public function review_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Review::find($request->id);
                $data->users_id = $request->users_id??$data->users_id;
                $data->courses_id = $request->courses_id??$data->courses_id;
                $data->rating = $request->rating??$data->rating;
                $data->your_review = $request->your_review??$data->your_review;
                $data->name = $request->name??$data->name;
                $data->email = $request->email??$data->email;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'users_id' => 'required',
                    'courses_id' => 'required',
                    'rating' => 'required',
                    'your_review' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Review;
                $data->users_id = $request->users_id;
                $data->courses_id = $request->courses_id;
                $data->rating = $request->rating;
                $data->your_review = $request->your_review;
                $data->name = $request->name;
                $data->email = $request->email;
               $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'review store successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'review not store successfully',
                ];
            }
            return response()->json(['success'=>true,'message'=>$result]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function review_list()
    {
        try {
            $data = Review::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'review show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function review_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
        }
        try {
            $data = Review::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'review delete successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
