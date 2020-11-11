<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Outline;
use App\Models\OutlineDetail;
use App\Models\Setting;
use App\Models\OutlineStructure;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class OutlineApiController extends Controller
{

    // public function detail(Request $request){
    //     $id =  $request -> input("id");

    //     $subject = Subject::where("id",$id)->first();

    //     if(!$subject){
    //         return response([ "message" => "Subject Not found."], 404);
    //     }
    //     return response([ "data" => $subject]);
    // }

    public function list(Request $request){

        $subject = Subject::get();

        return response([ "data" => $subject]);
    }

    public function delete(Request $request){
        $id =  $request -> input("id");

        $outline = Outline::where("id",$id)->first();

        if(!$outline){
            return response([ "message" => "Outline Not found."], 404);
        }
        $outline->delete();
        
        return response([ "data" => $outline]);
    }

    public function create(Request $request){

        try {
            //code...
            $validator = Validator::make($request->all(),['title'=> 'required|unique:outlines' , 'subject_id' => 'required' , 'user_id'=>'required' , 'is_practice'=>'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }
            
            $data = $request-> all();
            $data["version"] = 1;

            $outline = Outline::create($data);
            
            $newOutline = Outline::where("id",$outline->id)->with("subject")->first();
            $structures = null;
            if($newOutline->is_practice == 1){
                $structures = OutlineStructure::orderBy("sort","asc")->whereIn("sort",array(1 , 2 , 9))->get();
                Log::info($structures);
            }
            else{
                $structures = OutlineStructure::orderBy("sort","asc")->where("sort","!=",9)->get();
            }

            $setting = Setting::where("rule","name")->first();

            foreach($structures as $structure){
                $content = view("admin.sides.$structure->html_raw",["outline"=> $newOutline , "setting"=> $setting]);
                OutlineDetail::create(array('outline_id' => $newOutline->id, 'content'=>$content , 'sort'=>$structure->sort , 'structure_id'=> $structure->id));
            }
            
    
            return response([ "data" => $newOutline]);
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

            Subject::where("id",$data["id"])->update(["status"=> $data["status"] , "title" => $data["title"] , "subject_code"=> $data["subject_code"]]);

            $subject = Subject::find($data["id"]);

            return response($subject);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }

       
    }

}
