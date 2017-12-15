<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Validator;
use DB;

class SystemController extends Controller
{

    public function onlineAppointment(){
        $res = DB::table('form_guest')->orderBy('id','desc')->where(array())->select()->paginate(15);
//        var_dump($res);
        $status = ['未审核','已审核'];
        return View('admin.form_guest',['user'=>$res,'status'=>$status]);

    }

    public function appointDetail(Request $request){
        $id = $request->input('id');
        $res = DB::table('form_guest')->where(array('id'=>$id))->get();
        return View('admin.appointDetail',['data'=>$res[0]]);
    }
    public function appointModify(Request $request){
        $input = $request->all();
        $data =array('status'=>$input['status']);
        $result = DB::table('form_guest')->where('id',$input['id'])->update($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function buttonAppointment(){
        echo '底部预约';
    }

    public function complaint(){
        echo '投诉';
    }

}
