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
        $admin_id = $request->session()->get('admin_id');
        $is_admin = $request->session()->get('is_admin');
        if($is_admin){
            $map = [];
        }else{
            $map = ['to_id'=>$admin_id];
        }
        $resource = DB::table('admin_user')->orderBy('userid','desc')->where(array('is_resource'=>1))->select()->get();
        $admin = [];
        foreach($resource as $val){
            $admin[$val['userid']] = $val['username'];
        }
        $input = $request->all();
        $kw = isset($input['kw'])?$input['kw']:'';
        $user = DB::table('member')->orderBy('id','desc')->where($map)->where('username', 'like', $kw.'%')->orwhere('mobile', 'like', $kw.'%')->select()->paginate(15);
        $status = ['未审核','已审核'];
        return View('admin.user',['admin'=>$admin,'user'=>$user,'status'=>$status,'resource'=>$resource,'kw'=>$kw]);
    }

    //分配
    public function distribution(Request $request){
        $input = $request->all();
        $data = array(
            'to_id' => $input['admin_id'],
            'last_id' => $input['to'],
        );

        $result = DB::table('member')->where('id',$input['userid'])->update($data);
        if($result !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }


    public function trade(Request $request){
        $id = $request->input('id');
        $resource = DB::table('user_count')->orderBy('id','desc')->where(array('userid'=>$id))->select()->paginate(15);
        return View('admin.user_trade',['data'=>$resource,'id'=>$id]);
    }

    public function alltrade(Request $request){
        $d = $request->input('d')? $request->input('d'):3;
        $time = time() - (3600*24*$d);
        $sql = "select *,count(*) as seeNum from xiao_user_count where cid!=0 AND time >= {$time} group by cid order by seeNum desc limit 0,100";
        $resource = DB::select($sql);
        return View('admin.user_alltrade',['data'=>$resource,'d'=>$d]);

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
                'mark' => trim($input['mark']),
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
        $role = DB::table('admin_role')->orderBy('role_id','desc')->where(array())->select()->get();
        $roles = [];
        foreach($role as $val){
            $roles[$val['role_id']] = $val['role_name'];
        }
        return View('admin.adminuser',['user'=>$user,'status'=>$status,'role'=>$roles]);

    }

    public function addadmin(Request $request){
        $roles = DB::table('admin_role')->orderBy('role_id','desc')->where(array())->select()->get();
        return View('admin.adminuser_edit',['role'=>$roles]);

    }

    public function adminprofile(Request $request){
        $userid = $request->input('id');
        $info = DB::table('admin_user')->where(array('userid'=>$userid))->get();
        $info = current($info);
        $role = DB::table('admin_role')->orderBy('role_id','desc')->where(array())->select()->get();
        return View('admin.adminuser_edit',['data'=>$info,'role'=>$role]);

    }

    public function adminmodify(Request $request){
        $input = $request->all();
        $data = array(
            'username' => $input['username'],
            'role' => $input['role'],
            'status' => $input['status'],
            'is_admin' => $input['is_admin'],
            'is_resource' => $input['is_resource'],
        );
        if($input['id'] != ''){
            if(!empty($input['password'])){
                $data['password'] = md5(md5($input['repassword']));
            }
            $result = DB::table('admin_user')->where('userid',$input['id'])->update($data);
        }else{
            $data['password'] = md5(md5($input['password']));
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
