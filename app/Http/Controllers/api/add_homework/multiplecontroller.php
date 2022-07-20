<?php

namespace App\Http\Controllers\api\add_homework;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Models\Multiple_Choice;
class multiplecontroller extends Controller
{
    public function multiple_choice_store(Request $request)
    {
        try {
            if($request->id)
            {
                $data = Multiple_Choice::find($request->id);
                $data->text_homeworks_id =$request->text_homeworks_id ??$data->text_homeworks_id;
                $data->type_question=$request->type_question??$data->type_question;
                $data->number_of_options=$request->number_of_options??$data->number_of_options;
                $data->option_1=$request->option_1??$data->option_1;
                $data->option_2=$request->option_2??$data->option_2;
                $data->option_3=$request->option_3??$data->option_3;
                $data->option_4=$request->option_4??$data->option_4;
                $query=$data->save();
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'text_homeworks_id' => 'required',
                    'type_question' => 'required',
                    'number_of_options' => 'required',
                    'option_1' => 'required',
                    'option_2' => 'required',
                    'option_3' => 'required',
                    'option_4' => 'required',

                ]);
                if($validator->fails()){
                    return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
                }
                $data = new Multiple_Choice;
                $data->text_homeworks_id=$request->text_homeworks_id;
                $data->type_question=$request->type_question;
                $data->number_of_options=$request->number_of_options;
                $data->option_1=$request->option_1;
                $data->option_2=$request->option_2;
                $data->option_3=$request->option_3;
                $data->option_4=$request->option_4;
                $query=$data->save();
            }
            if($query)
            {
                $result = [
                    'success'=>true,
                    'message'=>'Multiple_Choice is save successfully',
                ];
            }
            else
            {
                $result = [
                    'success'=>false,
                    'message'=>'Multiple_Choice is not save successfully',
                ];
            }
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function multiple_choice_show()
    {
        try {
            $data = Multiple_Choice::all();
            return response()->json(['success'=>true,'data'=>$data,'message'=>'Multiple_Choice show successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getmessage()]);
        }
    }

    public function multiple_choice_delete(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false, 'data'=> json_decode(json_encode([],JSON_FORCE_OBJECT)), 'message'=> $validator->errors()->first()]);
            }
            $data = Multiple_Choice::find($request->id);
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Multiple_Choice delete successfully']);
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getmessage()]);
    }
    }
}
