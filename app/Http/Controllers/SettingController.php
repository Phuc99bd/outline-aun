<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
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
        $settings = Setting::orderBy("id","desc")->paginate($limit);
        // return response($subjects);
        $user = Auth::user();
        return view('admin.setting',[ "user" => $user , "settings" => $settings]);
    }

}
