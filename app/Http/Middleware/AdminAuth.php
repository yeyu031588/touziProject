<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Validator;
use DB;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->get('admin_id')){
           return redirect()->guest('AdminLogin');
        }
        $userid = $request->session()->get('admin_id');
        $role_id = $request->session()->get('role');
        $route = $request->path();
        if($role_id == 1){
            return $next($request);
        }
        $this->route($userid,$role_id,$route,$next,$request);
        return $next($request);

    }

    public function route($userid,$role_id,$route,$next,$request){
        $result = DB::table('route')->where(array('url'=>$route))->get();
        if($result){
            $per = DB::table('permissions')->where(array('role_id'=>$role_id))->get();
            if(!$per){
                echo 'no permissions';
                exit;
            }
            $per = json_decode($per);
            if(in_array($route,$per)){
                return $next($request);
            }else{
                echo 'no permissions';
                exit;
            }

        }else{
            return $next($request);

        }
    }



}
