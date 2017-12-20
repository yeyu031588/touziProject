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
  public function routeList(){
    return View('admin.route',['data'=>array()]);
  }

    public function editRoute(){
    echo '编辑 路由';
}

    public function dropRoute($id){

    }

    public function routeGroup(){
        $res = DB::table('route_group')->get();
        return View('admin.route_group',['data'=>$res]);

    }

    public function editGroup(Request $request){
        $input = $request->all();
        $data = array(
            'group' => $input['group']
        );
        $result = DB::table('route_group')->insert($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

}
