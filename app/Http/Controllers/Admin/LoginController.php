<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        if($request->session()->get('admin_id')){
            return redirect('/Admin');
        }
        if($request->isMethod('post')){
            $name = $request->input('name');
            $password = $request->input('password');
            $user = DB::table('admin_user')
                        ->where(array('username'=>$name))
                        ->select('username', 'userid','password','role','is_admin')
                        ->get();
            if(!$user){
                return redirect('/AdminLogin')->withErrors(array('用户不存在'))->withInput();
            }else{

                if($user[0]['password'] == md5(md5($password))){
                    $request->session()->set('admin_id',$user[0]['userid']);
                    $request->session()->set('role',$user[0]['role']);
                    $request->session()->set('is_admin',$user[0]['is_admin']);
                    $request->session()->set('admin_name',$user[0]['username']);
                    return redirect('/Admin');
                }else{
                    return redirect('/AdminLogin')->withErrors(array('密码错误'))->withInput();
                }
            }
        }

        return view('admin.login');
    }

    public function layout(Request $request)
    {
        $request->session()->set('admin_id','');
        $request->session()->set('admin_name','');
        return redirect('/AdminLogin');
    }
}
