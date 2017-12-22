<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Validator;
use DB;

class RouteController extends Controller
{

    public function __construct(Request $request){
//        echo $request->path();
    }

    public function routeList(){
      $group = DB::table('route_group')->orderBy('sort','DESC')->orderBy('id','ASC')->get();
      foreach($group as &$val){
          $result = DB::table('route')->where(array('group_id'=>$val['id']))->get();
          $val['urls'] = $result;
      }
      return View('admin.route',['data'=>array(),'group'=>$group]);
    }

    public function editRoute(Request $request){
        $input = $request->all();
        $data = array(
            'group_id' => intval($input['group_id']),
            'title' => trim($input['title']),
            'url' => trim($input['url']),
            'type' => intval($input['type']),
        );
        if(isset($input['route_id']) && !empty($input['route_id'])){
            $res = DB::table('route')->where(array('url'=>trim($input['url'])))->get();
            if($res && ($res[0]['route_id'] != $input['route_id'])){
                echo json_encode(['status'=>0,'msg'=>'该路由已存在']);
                exit;
            }
            $result = DB::table('route')->where('route_id',$input['route_id'])->update($data);
        }else{
            $res = DB::table('route')->where(array('url'=>trim($input['url'])))->get();
            if(!empty($res)){
                echo json_encode(['status'=>0,'msg'=>'该路由已存在']);
                exit;
            }
            $result = DB::table('route')->insert($data);
        }

        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function dropRoute(Request $request){
        $id = $request->input('id');
        DB::table('route')
            ->where('route_id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }

    public function routeGroup(){
        $res = DB::table('route_group')->get();
        return View('admin.route_group',['data'=>$res]);

    }

    public function editGroup(Request $request){
        $input = $request->all();
        $data = array(
            'group' => trim($input['group']),
            'sort' => intval($input['sort']),
        );
        if(isset($input['group_id']) && !empty($input['group_id'])){
            $res = DB::table('route_group')->where(array('group'=>trim($input['group'])))->get();
            if($res && ($res[0]['id'] != $input['group_id'])){
                echo json_encode(['status'=>0,'msg'=>'该分组已存在']);
                exit;
            }
            $result = DB::table('route_group')->where('id',$input['group_id'])->update($data);
        }else{
            $res = DB::table('route_group')->where(array('group'=>trim($input['group'])))->get();
            if(!empty($res)){
                echo json_encode(['status'=>0,'msg'=>'该分组已存在']);
                exit;
            }
            $result = DB::table('route_group')->insert($data);
        }

        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function dropGroup(Request $request){
        $id = $request->input('id');
        DB::table('route_group')
            ->where('id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }

    public function permissions(Request $request){
        $role_id = $request->input('id');
        $res = DB::table('permissions')->where(array('role_id'=>$role_id))->get();
        $res = current($res);
        $group = DB::table('route_group')->orderBy('sort','DESC')->orderBy('id','ASC')->get();
        foreach($group as &$val){
            $result = DB::table('route')->where(array('group_id'=>$val['id']))->get();
            $val['urls'] = $result;
        }
        $role = DB::table('admin_role')->where(array('role_id'=>$role_id))->get();
        $role = current($role);
        return View('admin.permissions',['group'=>$group,'role'=>$role,'permissions'=>json_decode($res['permissions'])]);
    }

    public function rolePremission(Request $request){
        $input = $request->all();
        $routes = json_encode($input['route']);
        $data = array(
            'permissions' => $routes,
        );
        $res = DB::table('permissions')->where(array('role_id'=>$input['role_id']))->get();
        if(!$res){
            $data['role_id'] =$input['role_id'];
            $result = DB::table('permissions')->insert($data);
        }else{
            $result = DB::table('permissions')->where(array('role_id'=>$input['role_id']))->update($data);
        }
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

}
