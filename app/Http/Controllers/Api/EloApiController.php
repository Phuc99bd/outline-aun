<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Elo;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;

class EloApiController extends Controller
{

    public function detail(Request $request){
        $id =  $request -> input("id");

        $elo = Elo::where("id",$id)->first();

        if(!$elo){
            return response([ "message" => "Elo Not found."], 404);
        }
        return response([ "data" => $elo]);
    }

    public function delete(Request $request){
        $id =  $request -> input("id");

        $elo = Elo::where("id",$id)->first();

        if(!$elo){
            return response([ "message" => "Elo Not found."], 404);
        }
        $elo->delete();
        
        return response([ "data" => $elo]);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(),['title'=> 'required|unique:elos']);

        if ($validator->fails()) {
        // Do something
            return response(["error"=> $validator->errors()],404);
        }

        $data = $request-> all();

        $elo = Elo::create($data);

        return response([ "data" => $elo]);
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

            $fillTitle = Elo::where("title",$data["title"])->where("id","!=",$data["id"])->first();

            if($fillTitle){
                return response(["error"=> ["title" => ["The title has already been taken"]]],404);
            }

            Elo::where("id",$data["id"])->update(["title" => $data["title"]]);

            $elo = Elo::find($data["id"]);

            return response($elo);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

}
