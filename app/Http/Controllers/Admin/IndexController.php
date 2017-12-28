<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function main(){
        $user_number = DB::table('member')->count();
        $new_user = DB::table('member')->where('status','eq',0)->count();
        $content_number = DB::table('content')->count();
        $content_wait = DB::table('content')->where('status','eq',0)->count();
        $data = array(
            'user_number' => $user_number,
            'new_user' => $new_user,
            'content_number' => $content_number,
            'content_wait' => $content_wait,
        );
        var_dump($data);
        return view('admin.main',['data'=>$data]);
    }
}
