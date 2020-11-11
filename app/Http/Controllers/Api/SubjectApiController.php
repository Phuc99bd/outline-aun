<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class SubjectApiController extends Controller
{

    public function detail(Request $request){
        $id =  $request -> input("id");

        $subject = Subject::where("id",$id)->first();

        if(!$subject){
            return response([ "message" => "Subject Not found."], 404);
        }
        return response([ "data" => $subject]);
    }

    public function list(Request $request){

        $subject = Subject::where("status",1)->get();

        return response([ "data" => $subject]);
    }

    public function delete(Request $request){
        $id =  $request -> input("id");

        $subject = Subject::where("id",$id)->first();

        if(!$subject){
            return response([ "message" => "Subject Not found."], 404);
        }
        $subject->delete();
        
        return response([ "data" => $subject]);
    }

    public function create(Request $request){

        try {
            //code...
            $validator = Validator::make($request->all(),['title'=> 'required|unique:subjects' , 'status' => 'required' , 'subject_code'=>'required|unique:subjects' , 'title_en'=>'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }
    
            $data = $request-> all();
            $subject = Subject::create($data);
    
            return response([ "data" => $subject]);
        } catch (Exception $e) {
            //throw $th;
            Log::info($e);
        }
      
    }

    public function update(Request $request){
        try {
            //code...
            $validator = Validator::make($request->all(),['status' => 'required', 'id' => 'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }
            $data = $request-> all();
            $fillTitle = Subject::where("title",$data["title"])->where("id","!=",$data["id"])->first();

            if($fillTitle){
                return response(["error"=> ["title" => ["The title has already been taken"]]],404);
            }
            $code = Subject::where("subject_code",$data["subject_code"])->where("id","!=",$data["id"])->first();

            if($code){
                return response(["error"=> ["code" => ["The code subject has already been taken"]]],404);
            }

            Subject::where("id",$data["id"])->update(["status"=> $data["status"] , "title" => $data["title"] , "subject_code"=> $data["subject_code"], 'title_en'=>$data["title_en"]]);

            $subject = Subject::find($data["id"]);

            return response($subject);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }

       
    }

}
