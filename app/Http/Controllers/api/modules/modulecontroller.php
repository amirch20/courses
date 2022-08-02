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
                $data->module_name = $request->name??$data->module_name;
                $data->subjects_id = $request->subjects_id??$data->subjects_id;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'module_name' => 'required',
                    'subjects_id'=>'required',
                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Module;
                $data->module_name = $request->module_name;
                $data->subjects_id = $request->subjects_id;
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

    public function module_list(Request $request)
    {
        try {
            $module = DB::table('modules')
            ->join('subjects','modules.subjects_id','=','subjects.id')
            ->select('modules.id','modules.module_name')
            ->get();
            $lession = DB::table('lessions')
            ->join('modules','lessions.modules_id','=','modules.id')
            ->select('lessions.lession_name')
            ->count();
        return response()->json(['success'=>true,'module'=>$module,'lession'=>$lession,'message'=>'module show successfully']);
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

    public function module_edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Module::where('id',$request->id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }
}
