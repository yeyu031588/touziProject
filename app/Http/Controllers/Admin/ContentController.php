<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ContentController extends Controller
{
    private  $cate=[
        1  => '股权项目',
        3  => '三板资讯',
        4  => '原创研究',
        5  => '视频中心',
        6  => '行情中心',
        8  => '三板头条',
        9  => '行业解析',
        10  => '政策解读',
        11  => '大咖访谈',
        12  => '学堂',
        13  => '三板调研',
        14  => '机构观点',
        15  => '项目分析',
        16 => '投资咨询',
        17 => '投资要闻',
        18 => '投资走向',
        19 => '投资百科',
        26 => '专题栏目',
        27 => '行情列表',
        33 => '企业栏目',
        34 => '搜索栏目',
        35 => '测试栏目',];

    //内容项目列表
    public function lists($cid=1,Request $request)
    {
        $input = $request->all();
        $kw = isset($input['kw'])?$input['kw']:'';
        $map = array('catid'=>$cid);
        $list = DB::table('content')->orderBy('id','desc')->where($map)->where('title', 'like', $kw.'%')->select()->paginate(15);
        return view('admin.content_list',['data'=>$list,'cate'=>$this->cate,'cid'=>$cid]);
    }
    public function add(Request $request){
        $input = $request->all();
        $default = 'add_guquan';
        if($input['cid'] != 1){
            $default = 'content_default';
        }
        return view('admin.'.$default,['data'=>[],'cid'=>$input['cid'],'cate'=>$this->cate]);

    }


    public function detail($id=0,Request $request){
        $data = [];
        $info = DB::table('content')->where(array('id'=>$id))->select()->get();
        if($info[0]['catid']==1){
            $deal = DB::table('content_deal')->where(array('id'=>$id))->select()->get();
            $data = array_merge($info[0],$deal[0]);
            return view('admin.guquan_detail',['data'=>$data,'cate'=>$this->cate]);
        }else{
            return view('admin.content_default_detail',['data'=>$info[0],'cate'=>$this->cate]);

        }

    }
    //股权项目专用
    public function modify(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            if($input['cid'] == 1){
                $this->guquan($input);
            }else{
                $this->commonModify($input);

            }
            exit;
        }
    }

    //股权
    public function guquan($input){
        $data = $input['data'];
        $content['catid'] = $input['cid'];
        $content['modelid'] = 6;
        $content['title'] = $data['title'];
        $content['thumb'] = $data['thumb'];
        $content['keywords'] = $data['keywords'];
        $content['description'] = $data['description'];
        $content['status'] = $data['status'];
        $content['hits'] = $data['hits'];
//        $content['new'] = 1;
        $content['username'] =  session('admin_name');
        $content['time'] =  isset($data['time'])&& !empty($data['time'])?strtotime($data['time']):time();
        $content_detail['catid'] = 1;
        $content_detail['qyjj'] = isset($input['jianjie'])?$input['jianjie']:'';
        $content_detail['rzjh'] = isset($input['jihua'])?$input['jihua']:'';
        $content_detail['qyld'] = isset($input['liangdian'])?$input['liangdian']:'';
        $content_detail['scjz'] = isset($input['price'])?$input['price']:'';
        $content_detail['tzlc'] = isset($input['process'])?$input['process']:'';
        $content_detail['shjh'] = isset($input['callback'])?$input['callback']:'';
        $content_detail['content'] = isset($input['content'])?$input['content']:'';
        $content_detail['state'] = $data['state'];
        $content_detail['leixing'] = $data['leixing'];
        $content_detail['area'] = $data['area'];
        $content_detail['industry'] = $data['industry'];
        $content_detail['guquandaima'] = $data['guquandaima'];
        $content_detail['mc'] = $data['mc'];
        $content_detail['gslogo'] = $data['gslogo'];
        $content_detail['youzhixiangmu'] = $data['youzhixiangmu'];
        $content_detail['rq'] = $data['rq'];
        $content_detail['zczb'] = $data['zczb'];
        $content_detail['cltime'] = $data['cltime'];
        $content_detail['stu'] = $data['stu'];
        $content_detail['bcfx'] = $data['bcfx'];
        $content_detail['cygs'] = $data['zbqs'];
        $content_detail['zbqs'] = $data['cygs'];
        $content_detail['qtgs'] = $data['qtgs'];
        $content_detail['bcrz'] = $data['bcrz'];
        $content_detail['jingzichan'] = $data['jingzichan'];
        $content_detail['zgb'] = $data['zgb'];
        $content_detail['shiyinglv'] = $data['shiyinglv'];
        $content_detail['shouyi'] = $data['shouyi'];
        $content_detail['yujiguapai'] = $data['yujiguapai'];
        $content_detail['sshouyi'] = $data['sshouyi'];
        $content_detail['xiangmujindu'] = $data['xiangmujindu'];
        $content_detail['yshouyi'] = $data['yshouyi'];
        $content_detail['yy'] = $data['yy'];
        $content_detail['xgwz'] = $data['xgwz'];
        if(!isset($input['id'])){
            $id = DB::table('content')->insertGetId($content);
            $content_detail['id'] = $id;
            $res = DB::table('content_deal')->insert($content_detail);
        }else{
            $id = DB::table('content')->where('id',$input['id'])->update($content);
            $res = DB::table('content_deal')->where('id',$input['id'])->update($content_detail);
        }

        if($res !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    //公通用文章编辑
    public function commonModify($input){
        $data = $input['data'];
        $content['catid'] = $input['cid'];
        $content['modelid'] = 6;
        $content['title'] = $data['title'];
        $content['thumb'] = $data['thumb'];
        $content['keywords'] = $data['keywords'];
        $content['description'] = $data['description'];
        $content['status'] = $data['status'];
        $content['hits'] = $data['hits'];
//        $content['new'] = 1;
        $content['username'] =  session('admin_name');
        $content['time'] =  isset($data['time'])&& !empty($data['time'])?strtotime($data['time']):time();
        $content_detail['content'] = isset($input['content'])?$input['content']:'';



        if(!isset($input['id'])){
            $id = DB::table('content')->insertGetId($content);
            $content_detail['id'] = $id;
            $res = DB::table('content_deal')->insert($content_detail);
        }else{
            $res = DB::table('content')->where('id',$input['id'])->update($content);
            $res = DB::table('content_deal')->where('id',$input['id'])->update($content_detail);
        }

        if($res !== false){
            echo json_encode(['status'=>200]);
            exit;
        }
    }

    //根据不同分类获取自定义的值
    public function getSelfField($cid){

    }

}
