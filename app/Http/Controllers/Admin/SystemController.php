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

    public function appointDrop(Request $request){
        $id = $request->input('id');
        DB::table('form_guest')
            ->where('id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }


    public function buttonAppointment(){
        $res = DB::table('form_dyy')->orderBy('id','desc')->where(array())->select()->paginate(15);
//        var_dump($res);
        $status = ['未审核','已审核'];
        return View('admin.form_button',['data'=>$res,'status'=>$status]);
    }

    public function buttonAppDetail(Request $request){
        $id = $request->input('id');
        $res = DB::table('form_dyy')->where(array('id'=>$id))->get();
        return View('admin.form_button_detail',['data'=>$res[0]]);
    }

    public function buttonAppDrop(Request $request){
        $id = $request->input('id');
        DB::table('form_dyy')
            ->where('id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }
    public function buttonAppModify(Request $request){
        $input = $request->all();
        $data =array('status'=>$input['status']);
        $result = DB::table('form_dyy')->where('id',$input['id'])->update($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function complaint(){
        $res = DB::table('form_service')->orderBy('id','desc')->where(array())->select()->paginate(15);
        $status = ['未处理','已处理'];
        return View('admin.complaint',['data'=>$res,'status'=>$status]);

    }

    public function complaintDetail(Request $request){
        $id = $request->input('id');
        $res = DB::table('form_service')->where(array('id'=>$id))->get();
        return View('admin.complaint_detail',['data'=>$res[0]]);
    }

    public function complaintModify(Request $request){
        $input = $request->all();
        $data =array(
            'status'=>$input['status']
        );
        $result = DB::table('form_service')->where('id',$input['id'])->update($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function complaintDrop(Request $request){
        $id = $request->input('id');
        DB::table('form_service')
            ->where('id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }

}
