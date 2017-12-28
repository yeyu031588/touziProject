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
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->get('admin_id')){
           return redirect()->guest('AdminLogin');
        }
        $userid = $request->session()->get('admin_id');
        $role_id = $request->session()->get('role');
        $is_admin = $request->session()->get('is_admin');
        $route = $request->path();
        if($is_admin == 1){
            return $next($request);
        }
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $type =  'ajax';
        }else{
            $type =  'normal';
        };
        $this->route($userid,$role_id,$route,$next,$request,$type);
        return $next($request);

    }

    public function route($userid,$role_id,$route,$next,$request,$type){
        $result = DB::table('route')->where(array('url'=>$route))->get();
        if($result){
            $per = DB::table('permissions')->where(array('role_id'=>$role_id))->get();
            if(!$per){
                if($type=='ajax'){
                    echo json_encode(['status'=>0,'msg'=>'没权限']);
                    exit;
                }else{
                    echo 'no permissions';
                    exit;
                }

            }
            $per = json_decode($per[0]['permissions']);
            if(in_array($result[0]['route_id'],$per)){
                return $next($request);
            }else{
                if($type=='ajax'){
                    echo json_encode(['status'=>0,'msg'=>'没权限']);
                    exit;
                }else{
                    echo 'no permissions';
                    exit;
                }
            }

        }else{
            return $next($request);

        }
    }



}
