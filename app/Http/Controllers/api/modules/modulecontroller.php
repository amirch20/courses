<?php

namespace App\Http\Controllers\api\modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Module;
use App\Models\Lession;
class modulecontroller extends Controller
{
    public function module_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Module::find($request->id);
                $data->name = $request->name??$data->name;
                $data->lessions_id = $request->lessions_id??$data->lessions_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'lessions_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Module;
                $data->name = $request->name;
                $data->lessions_id = $request->lessions_id;
               $query=$data->save();
            }
                    if($query)
                    {
                        $result=[
                            'success'=>true,
                            'message'=>'Models is save successfully',
                        ];
                    }
                    else
                    {
                        $result=[
                            'success'=>false,
                            'message'=>'Models is not save',
                        ];
                    }
                    return response()->json($result);

        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
        }

    public function module_list()
    {
        
        try {
            $lession = DB::table('lessions')
        ->join('modules','modules.lessions_id','=','lessions.id')
        ->select('lessions.name')->count();
        $data = DB::table('lessions')
        ->join('modules','modules.lessions_id','=','lessions.id')
        ->select('modules.name')->get();
        return response()->json(['success'=>true,'data'=>$data,'lession'=>$lession,'message'=>'module show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function module_delete(Request $request)
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
                $data = Module::find($request->id);
                $data->delete();
                return response()->json(['success'=>true,'message'=>'Module delete successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message'=>$th->getmessage()]);
            }
        }
    }
}
