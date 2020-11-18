<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Outline;
use App\Models\User;

class HomeController extends Controller
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
    public function index()
    {
        $countOutline = null;
        $countVersion = null;
        $countUser = User::count();
        $user = Auth::user();
        if($user->role == 1){
            $countOutline = Outline::count();
            $countVersion = Outline::count();;
        }
        else{
            $countOutline =  Outline::where("user_id", $user->id)->count();;
            $countVersion =  Outline::where("user_id", $user->id)->count();;
        }
        return view('admin.dashboard',[ "user" => $user , "title" => "Dashboard" , "countUser"=> $countUser , "countOutline"=> $countOutline , "countVersion"=> $countVersion]);
    }

    public function userInfo()
    {
        $user = Auth::user();

        return view('admin.user_profile', [ "user" => $user , "title" => "User Infomation"]);
    }

    public function updateInfomation(Request $request){
        $user = Auth::user();

        $name = $request->input("name");

        User::where("id",  $user->id)->update(["name" => $name]);
        return $this->userInfo();
    }
}
