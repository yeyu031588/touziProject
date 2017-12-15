@extends('layout.admin')
@section('extendCss')
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }
    </style>
@show

@section('title', '后台首页')
@section('content')
    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
        <input type="hidden" value="{{$data['id']}}" name="id"/>
        <input type="hidden" value="{{$data['modelid']}}" name="modelid"/>
        <div class="layui-form-item">
            <label class="layui-form-label">会员名</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{$data['username']}}" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">归属</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input"  value="<?php if($data['modelid'] == 5){echo '个人投资者';}else{echo '机构投资者';}?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{$data['email']}}" name="email">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" placeholder="请输入邮箱" name="password">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册时间</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{date('Y-m-d H:i:s',$data['regdate'])}}" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册IP</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{$data['regip']}}" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <select name="status" class="userStatus">
                        <option value="1" <?php if($data['status']==1)echo 'selected';?>>审核</option>
                        <option value="0" <?php if($data['status']==0)echo 'selected';?>>未审核</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{$data['mobile']}}" name="mobile">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addUser" id="sub">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

@endsection
@section('extendJs')
    <script type="text/javascript" src="{{ URL::asset('/js/admin/addUser.js') }}"></script>
@endsection