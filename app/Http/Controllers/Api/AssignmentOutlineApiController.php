<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;
use App\Models\AssignmentOutline;
use App\Models\Subject;

class AssignmentOutlineApiController extends Controller
{
    public function list(Request $request){
        try {
            $id = $request->input("id");
            $subject_id = $request->input("subject_id");
            $listUserAssign = AssignmentOutline::where("outline_assign_id", $subject_id)->pluck("user_id");
            $users = User::where("faculty_id", $id)->whereNotIn("id" , $listUserAssign)->get();
            return response([ "data" => $users] );
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
       
    }
    public function listAssign(Request $request){
        try {
            $subject_id = $request->input("subject_id");
            $listUserAssign = AssignmentOutline::where("outline_assign_id", $subject_id)->pluck("user_id");
            $users = User::whereIn("id" , $listUserAssign)->get();
            return response([ "data" => $users] );
        } catch (\Throwable $th) {
            //throw $th;
            return response($th,500);
        }
       
    }
    
    public function add(Request $request){
        $data = $request-> all();
        $outline = AssignmentOutline::create($data);
        $subject = Subject::orderBy("id","desc")->where("id",$data["outline_assign_id"])->with("faculty")->with("listAssignment")->with("listCompleted")->first();
        return response([ "data" => $subject] );
    }

    public function remove(Request $request){
        $id = $request->input("id");
        $subject_id = $request->input("subject_id");


        $deleted = AssignmentOutline::where("outline_assign_id", $subject_id)->where("user_id",$id)->delete();
        $subject = Subject::orderBy("id","desc")->where("id",$subject_id)->with("faculty")->with("listAssignment")->with("listCompleted")->first();

        return response([ "data" => $subject] );
    }
}
