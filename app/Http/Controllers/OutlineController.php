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

    public function exportWord(Request $request)
    {
        $id = $request -> input("id");

        $outline = Outline::where("id",$id)
        ->with("subject")
        ->with("outlineDetails")
        ->first();
        $title = $this->makeTitle($outline->title);
        $headers = array(
            "Content-type"=>"text/html",
    
            "Content-Disposition"=>"attachment;Filename=$title.doc"
        );

        $content = ' <html xmlns:v="urn:schemas-microsoft-com:vml" 
        xmlns:o="urn:schemas-microsoft-com:office:office" 
        xmlns:w="urn:schemas-microsoft-com:office:word" 
        xmlns="http://www.w3.org/TR/REC-html40"> 
         
        <head> 
        <meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
        <meta name=ProgId content=Word.Document> 
        <meta name=Generator content="Microsoft Word 9"> 
        <meta name=Originator content="Microsoft Word 9"> </head>

            <body>';
        foreach($outline->outlineDetails as $detail){
            $content = $content.$detail->content;
        }
        
        $content = $content."
            </body>

            </html>";
        // return response($subjects);
        return \Response::make($content,200, $headers);
    }

    public function makeTitle($strTitle)
    {
        $strTitle=strtolower($strTitle);
        //Code loại bỏ ký hiệu đặc biệt
        $strTitle=trim($strTitle);//Loại bỏ các dấu cách(khoảng trắng) ở đầu và cuối 1 chuỗi
        $strTitle=str_replace(' ','-',$strTitle);
        $strTitle=preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/",'o',$strTitle);
        $strTitle=preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/",'o',$strTitle);
        $strTitle=preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/",'a',$strTitle);
        $strTitle=preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/",'a',$strTitle);
        $strTitle=preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/",'e',$strTitle);
        $strTitle=preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/",'e',$strTitle);
        $strTitle=preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/",'u',$strTitle);
        $strTitle=preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/",'u',$strTitle);
        $strTitle=preg_replace("/(ì|í|ị|ỉ|ĩ)/",'i',$strTitle);
        $strTitle=preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'i',$strTitle);
        $strTitle=preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/",'y',$strTitle);
        $strTitle=preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",'y',$strTitle);
        $strTitle=str_replace('đ','d',$strTitle);
        $strTitle=str_replace('Đ','d',$strTitle);
        $strTitle=preg_replace("/[^-a-zA-Z0-9]/",'',$strTitle);
        return $strTitle;
    }

}
