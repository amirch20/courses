<?php

namespace App\Http\Controllers\api\lession;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Lession;
class lessioncontroller extends Controller
{
    public function lession_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Lession::find($request->id);
                $data->name = $request->name??$data->name;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Lession;
                $data->name = $request->name;
                $query=$data->save();
            }
                    if($query)
                    {
                        $result=[
                            'success'=>true,
                            'message'=>'lession is save successfully',
                        ];
                    }
                    else
                    {
                        $result=[
                            'success'=>false,
                            'message'=>'lession is not save',
                        ];
                    }
                    return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
        }

    public function lession_list()
    {
        try {
            $data = Lession::all();
            $quiz = DB::table('lessions')
        ->join('add_assessments','lessions.id','=','add_assessments.lessions_id')
        ->select('add_assessments.quiz_title')
        ->count();
            return response()->json(['success'=>true,'data'=>$data,'quiz'=>$quiz,'message'=>'lession show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function lession_delete(Request $request)
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
                $data = Lession::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'lession delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }

    public function lession_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Lession::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>$th->getmessage()]);
        }
    }
}
