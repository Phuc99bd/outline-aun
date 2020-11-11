<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Outline;
use App\Models\OutlineDetail;

class OutlineDetailController extends Controller
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
        $id = $request -> input("id");
        $user = Auth::user();

        $outline = Outline::where("user_id",$user->id)->where("id" , $id)
        ->first();
        if(!$outline){
            return route('dashboard');
        }
        $outlineDetails = OutlineDetail::where("outline_id",$outline->id)->with("outlineStructure")->get(); 

        return view('admin.outline_detail',[ "user" => $user , "outlineDetails" => $outlineDetails]);
    }

}
