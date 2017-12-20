<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Validator;
use DB;

class UserController extends Controller
{
    //用户列表
    public function index(Request $request)
    {
        $user = DB::table('member')->orderBy('id','desc')->where(array())->select()->paginate(15);
        $status = ['未审核','已审核'];
        return View('admin.user',['user'=>$user,'status'=>$status]);
    }

    public function newuser(Request $request)
    {
        if($request->isMethod('post')){
            $username = $request->input('username');
            $mobile = $request->input('mobile');
            $email = $request->input('email');
            $job = $request->input('job');
            $commpany = $request->input('company');
            $status = $request->input('status',1);
            $prov = $request->input('prov','');
            $city = $request->input('city','');
            $area = $request->input('area','');
            $address = $request->input('address');
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:6|max:18|regex:/^[a-zA-Z0-9_]+$/',
                'mobile' => 'required|unique:user,mobile',
                'email' => 'required|unique:user,email',
            ]);
            if ($validator->fails()) {
                return redirect('/Admin/newuser')->withErrors($validator)->withInput();
            }
            $data = array(
                'username' => $username,
                'mobile' => $mobile,
                'status' => 1,
                'email' => $email,
                'job' => $job,
                'company' => $commpany,
                'province' => $prov,
                'city' => $city,
                'area' => $area,
                'address' => $address,
            );
            $result = DB::table('user')->insert($data);
            if($result){
                return redirect('/Admin/newuser')->with('status', '用户添加成功！');
            }
        }
        return View('admin.newuser');
    }

    public function modify(Request $request){
            $input = $request->all();
            $data = array(
                'email' => $input['email'],
                'status' => $input['status'],
                'email' => $input['email'],
            );

            if($input['password']){
                $data['password'] = $input['password'];

            }
            $result = DB::table('member')->where('id',$input['id'])->update($data);
            if($input['modelid']==5){
                $table = 'member_geren';
            }else{
                $table = 'member_qiye';
            }
            $res = DB::table($table)->where('id',$input['id'])->update(['tel'=>$input['mobile']]);
            if($result !== false){
                echo json_encode(['status'=>200]);
                exit;
            }

    }

    public function profile(Request $request){
        $userid = $request->input('id');
        $info = DB::table('member')->where(array('id'=>$userid))->get();
        $info = current($info);
        if($info && $info['modelid']==5){
            //个人投资者
            $res = DB::table('member_geren')->where(array('id'=>$userid))->select(['tel'])->get();
        }else{
            //机构投资者
            $res = DB::table('member_geren')->where(array('id'=>$userid))->select(['tel'])->get();

        }
        if($res){
            $info['mobile'] = $res[0]['tel'];
        }
        return View('admin.user_profile',['data'=>$info]);
    }

    public function drop(Request $request){
        $userid = $request->input('userid');
        DB::table('member')
            ->where('id', $userid)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }

    public function registerCount(Request $request){
        $input = $request->all();
        if(!empty($input['time'])){
            $m = date('m',strtotime($input['time']));
            $d = date('t',strtotime($input['time']));
            $y = date('Y',strtotime($input['time']));
            if($y == date('Y') && $m == date('m')){
                $d = date('d');
            }
        }else{
            $m = date('m');
            $d = date('d');
            $y = date('Y');
        }

        $num = [];
        $day = [];
        $md = [];
        for($i=1;$i<=intval($d);$i++){
            $md[] = $m.'.'.$i;
            $bt = mktime(0,0,0,$m,$i,$y);
            $et = mktime(0,0,0,$m,$i+1,$y)-1;
            $day[] = array('beginToday'=>$bt,'endToday'=>$et);
            $count=DB::table('member')
                ->where('regdate','>=',$bt)
                ->where('regdate','<',$et)
                ->select('id')
                ->count();
            $num[] = $count;
        }
        return View('admin.user_count',['num'=>$num,'md'=>$md,'y'=>$y,'m'=>$m]);
    }

    //管理员
    public function adminUser(){
        $user = DB::table('admin_user')->orderBy('userid','desc')->where(array())->select()->get();
        $status = [0=>'未审核',1=>'审核'];
        $role = [1=>'业务员',2=>'编辑'];
        return View('admin.adminuser',['user'=>$user,'status'=>$status,'role'=>$role]);

    }

    public function addadmin(Request $request){
        return View('admin.adminuser_edit');

    }

    public function adminprofile(Request $request){
        $userid = $request->input('id');
        $info = DB::table('admin_user')->where(array('userid'=>$userid))->get();
        $info = current($info);
        return View('admin.adminuser_edit',['data'=>$info]);

    }

    public function adminmodify(Request $request){
        $input = $request->all();
        $data = array(
            'username' => $input['username'],
            'role' => $input['role'],
            'password' => $input['password'],
            'status' => $input['status'],
        );
        if($input['id'] != ''){
            $result = DB::table('admin_user')->where('userid',$input['id'])->update($data);
        }else{
            $result = DB::table('admin_user')->insert($data);

        }
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    public function dropAdmin(Request $request){
        $userid = $request->input('userid');
        DB::table('admin_user')
            ->where('userid', $userid)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }

    public function role(){
        $status = [0=>'未审核',1=>'审核'];
        $res = DB::table('admin_role')->orderBy('role_id','desc')->where(array())->select()->get();
        return View('admin.admin_role',['data'=>$res,'status'=>$status]);
    }

    public function editRole(Request $request){
        $input = $request->all();
        if($request->isMethod('post')){
            $data = array(
                'role_name' => $input['role_name'],
                'status' => $input['status'],
            );
            if($input['role_id'] != ''){
                $result = DB::table('admin_role')->where('role_id',$input['role_id'])->update($data);
            }else{
                $result = DB::table('admin_role')->insert($data);

            }
            if($result !== false){
                echo json_encode(['status'=>200]);
                exit;
            }
        }
        $res = [];
        if(isset($input['id'])){
            $res = DB::table('admin_role')->where(array('role_id'=>$input['id']))->get();
            $res = current($res);
        }
        return View('admin.edit_role',['data'=>$res]);

    }

    public function dropRole(Request $request){
        $role_id = $request->input('role_id');
        DB::table('admin_role')
            ->where('role_id', $role_id)
            ->delete();
        return response()->json(array(
            'status' => 1,
            'msg' => 'ok',
        ));
    }
}
