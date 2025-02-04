<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Faculty;

class SubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $page = $request -> input("page") || 1;
        $limit = $request -> input("limit") ? $request -> input("limit") : 10;
        $subjects = Subject::orderBy("id","desc")->with("faculty")->with("listAssignment")->with("listCompleted")->paginate($limit);
        $faculties = Faculty::get();
        // return response($subjects);
        $user = Auth::user();
        return view('admin.subject',[ "user" => $user , "subjects" => $subjects , "title" => "Manager subject" , "faculties"=> $faculties]);
    }

}
