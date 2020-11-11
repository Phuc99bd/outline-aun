<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Outline;

class OutlineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $user = Auth::user();

        $outlines = Outline::where("user_id",$user->id)->orderBy("created_at","desc")
        ->with("subject")
        ->paginate($limit);

        // return response($subjects);
        return view('admin.outline',[ "user" => $user , "outlines" => $outlines]);
    }

    public function preview(Request $request)
    {
        $id = $request -> input("id");
        $user = Auth::user();

        $outline = Outline::where("user_id",$user->id)
        ->where("id",$id)
        ->with("subject")
        ->with("outlineDetails")
        ->first();

        // return response($subjects);
        return view('admin.preview',[ "user" => $user , "outline" => $outline]);
    }

}
