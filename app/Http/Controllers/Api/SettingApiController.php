<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;

class SettingApiController extends Controller
{

    public function detail(Request $request){
        try {
            $id =  $request -> input("id");

            $setting = Setting::where("id",$id)->first();

            if(!$setting){
                return response([ "message" => "Setting Not found."], 404);
            }
            return response([ "data" => $setting]);
            //code...
        } catch (Exeception $th) {
            //throw $th;
            Log::info($th);
        }
        
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

            $fillTitle = Setting::where("title",$data["title"])->where("id","!=",$data["id"])->first();

            if($fillTitle){
                return response(["error"=> ["title" => ["The title has already been taken"]]],404);
            }

            Setting::where("id",$data["id"])->update(["title" => $data["title"] , "value"=> $data["value"] , "description"=> $data["description"] , "rule" => "admin"]);

            $setting = Setting::find($data["id"]);

            return response($setting);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

       
    }

}
