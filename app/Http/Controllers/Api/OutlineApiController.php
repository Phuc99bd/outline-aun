<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Outline;
use App\Models\Subject;
use App\Models\OutlineDetail;
use App\Models\Setting;
use App\Models\OutlineStructure;
use App\Models\Elo;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use Dompdf\Dompdf;
use App\Models\User;

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
            $elos = Elo::get();
            foreach($structures as $structure){
                $content = view("admin.sides.$structure->html_raw",["outline"=> $newOutline , "setting"=> $setting , "elos" => $elos]);
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
            $validator = Validator::make($request->all(),['title' => 'required', 'id' => 'required']);

            if ($validator->fails()) {
            // Do something
                return response(["error"=> $validator->errors()],404);
            }
            $data = $request-> all();
            $fillTitle = Outline::where("title",$data["title"])->where("id","!=",$data["id"])->first();

            if($fillTitle){
                return response(["error"=> ["title" => ["The title has already been taken"]]],404);
            }

            Outline::where("id",$data["id"])->update(["subject_id"=> $data["subject_id"] , "title" => $data["title"]]);

            $outline = Outline::where("id",$data["id"])->with("subject")->first();

            return response(["data" => $outline ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

    public function detail(Request $request){
        try {
            $id = $request->input("id");

            $outline = Outline::find($id);

            if(!$outline){
                return response(["error"=> ["outline" => ["Outline not found."]]], 404);
            }
            $subjects = Subject::where("status",1)->get();

            return response(["data" => $outline , "subjects"=> $subjects ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

    public function history(Request $request){
        try {
            $id = $request->input("id");

            $historyUser = Outline::where("user_id", $id)->with("subject")->limit(10)->orderBy("updated_at","desc")->get();

            return response(["data" => $historyUser  ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
    }

    public function exportPdf(Request $request){
        try {
            $id = $request->input("id");
            $dompdf = new Dompdf();
            // Enable the HTML5 parser to tolerate poorly formed HTML
            $dompdf->set_option('isHtml5ParserEnabled', true);

            $content = "";
            $outline = Outline::where("id",$id)
            ->with("subject")
            ->with("outlineDetails")
            ->first();
            if(!$outline){
                return response(["error"=> ["outline" => ["Outline not found."]]], 404);
            }
            foreach($detail as $outline->outlineDetails){
                $content = $content.$detail;
            }

            $dompdf->loadHtml($content);

            // Render and download
            $dompdf->render();
            $dompdf->stream();

            return response(["data" => $outline]);
        } catch (\Throwable $th) {
            //throw $th;
            return response("Bug".$th,500);
        }
    }

    public function chart(Request $request){
        try {
            $date = date('YYYY-MM-DD', strtotime("-30 days"));
            $outlines = Outline::where("created_at",">",$date)->get();
            $users = User::where("created_at",">",$date)->get();
            return response(["data" => ["users"=> $users , "outlines"=> $outlines]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response("Bug".$th,500);
        }
    }

    public function cloneUpVersion(Request $request){
        try {
            $id = $request->input("id");
            
            $outline = Outline::where("id",$id)->first();
            $versionNew = $outline->version + 1;
            $date = time();
            $newOutline = Outline::create(["title"=> $outline->title."($versionNew)-$date" , "version" => $versionNew , "user_id"=> $outline->user_id , "is_practice"=> $outline->is_practice , "subject_id"=> $outline->subject_id]);

            foreach($outline->outlineDetails as $detail){
                OutlineDetail::create([ "outline_id"=> $newOutline->id , "content"=> $detail->content , "sort" => $detail->sort , "structure_id" => $detail->structure_id]);
            }

            $newData = Outline::where("id",$newOutline->id)->with("subject")->first();

            return response(["data" => $newData]);
        } catch (\Throwable $th) {
            throw $th;
            return response($th,500);
        }
    }


}
