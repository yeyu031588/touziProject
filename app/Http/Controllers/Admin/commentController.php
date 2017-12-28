<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Validator;
use DB;

class CommentController extends Controller
{

    public function commentList(Request $request){
        $input = $request->all();
        $kw = isset($input['kw'])?$input['kw']:'';
        $res = DB::table('form_comment')->where('pinglunneirong', 'like', $kw.'%')->orderBy('id','desc')->select()->paginate(15);
        $status = [0=>'未审核',1=>'已审核'];
        return View('admin.comment',['data'=>$res,'status'=>$status]);
    }

    public function detail(Request $request){
        $id = $request->input('id');
        $res = DB::table('form_comment')->where(array('id'=>$id))->select()->get();
        return View('admin.comment_detail',['data'=>$res[0]]);

    }

    public function modify(Request $request){
        $input = $request->all();
        $data = array(
            'status' => $input['status'],
        );

        $result = DB::table('form_comment')->where('id',$input['id'])->update($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }


    public function drop(Request $request){
        $id = $request->input('id');
        DB::table('form_comment')
            ->where('id', $id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));    }

}
