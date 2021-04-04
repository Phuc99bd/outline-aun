<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Faculty;

class FacultyApiController extends Controller
{
    public function detail(Request $request){
        $id =  $request -> input("id");

        $faculty = Faculty::where("id",$id)->first();

        if(!$faculty){
            return response([ "message" => "Faculty Not found."], 404);
        }
        return response([ "data" => $faculty]);
    }

    public function delete(Request $request){
        $id =  $request -> input("id");

        $faculty = Faculty::where("id",$id)->first();

        if(!$faculty){
            return response([ "message" => "Faculty Not found."], 404);
        }
        $faculty->delete();
        
        return response([ "data" => $faculty]);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(),['title'=> 'required|unique:faculties']);

        if ($validator->fails()) {
        // Do something
            return response(["error"=> $validator->errors()],404);
        }

        $data = $request-> all();

        $faculty = Faculty::create($data);

        return response([ "data" => $faculty]);
    }

    public function update(Request $request){
        try {
            //code...
            $validator = Validator::make($request->all(),['id' => 'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }
            $data = $request-> all();

            $fillTitle = Faculty::where("title",$data["title"])->where("id","!=",$data["id"])->first();

            if($fillTitle){
                return response(["error"=> ["title" => ["The title has already been taken"]]],404);
            }

            Faculty::where("id",$data["id"])->update(["title" => $data["title"]]);

            $faculty = Faculty::find($data["id"]);

            return response($faculty);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }
}
