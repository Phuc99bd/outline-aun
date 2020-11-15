<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\OutlineDetail;
use App\Models\OutlineStructure;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class OutlineDetailApiController extends Controller
{
    public function detail(Request $request){
        try {
            $id = $request->input("id");

            $outlineDetail = OutlineDetail::where("id", $id)->with("outlineStructure")->first();

            if(!$outlineDetail){
                return response(["error"=> ["outlineDetail" => ["OutlineDetail not found."]]], 404);
            }

            return response(["data" => $outlineDetail ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

    public function update(Request $request){
        try {
            $validator = Validator::make($request->all(),['content' => 'required', 'id' => 'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }

            $id = $request->input("id");
            $content = $request->input("content");

            $outlineDetail = OutlineDetail::where("id", $id)->update([ "content"=> $content]);

            return response(["data" => $outlineDetail ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

}
