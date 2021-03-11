<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where("email", $row["email"])->first();
        if(!$user){
            return new User([
                'name'     => $row['name'],
                'email'    => $row['email'], 
                'password' => Hash::make($row['password']),
                'faculty' => $row['faculty']
            ]);
        }
    }
}

class UserApiController extends Controller
{
    public function importUser(Request $request) 
    {
        // return response(request()->file('file'))
        $check=Excel::import(new UsersImport,request()->file('file'));
        if($check)return response('Import thành công'); 
        else return response('error','Có lỗi xảy ra');
    }
}


