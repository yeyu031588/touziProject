@extends('layout.admin')
@section('extendCss')
    <link rel="stylesheet" href="{{ URL::asset('/css/user.css') }}" media="all" />
    <style>
        .layui-form-label{width: 100px;}
    </style>
@show
@section('title', '后台首页')
@section('content')
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <form action="" id="searchForm" method="get">
                <div class="layui-input-inline">
                    <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" name="kw">
                </div>
                <a class="layui-btn search_btn">查询</a>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal usersAdd_btn">添加用户</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
        </div>
        <div class="layui-inline">
            <div class="layui-form-mid layui-word-aux"></div>
        </div>
    </blockquote>

    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
                <th>登录名</th>
                <th>状态</th>
                <th>当前分配</th>
                {{--<th>注册IP</th>--}}
                <th>备注</th>
                <th>来源</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($user))

            @forelse($user as $val)

                <tr>
                    <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="{{$val['id']}}"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                    <td>{{$val['username']}}</td>
                    <td <?php if($val['status']==0){echo 'style="color:red;"';}?>>{{$status[$val['status']]}}</td>
                    <td <?php if($val['to_id']==0){echo 'style="color:red;"';}?>><?php if($val['to_id']){echo $admin[$val['to_id']];}else{echo '暂未分配';}?></td>
                    {{--<td>{{$val['regip']}}</td>--}}
                    <td>{{$val['mark']}}</td>
                    <td>@if(isset($val['device']) && $val['device'] =='pc') 电脑 @endif @if(isset($val['device']) && $val['device'] =='mobile') 手机 @endif</td>
                    <td>{{date('Y-m-d H:i:s',$val['regdate'])}}</td>
                    <td>
                        <a href="<?php echo URL::action('Admin\UserController@profile',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-mini" href="<?php echo URL::action('Admin\UserController@dis',['id'=>$val['id']]);?>"> 分配</a>
                        <a class="layui-btn layui-btn-danger layui-btn-mini" href=""> 标记</a>
                        <a href="<?php echo URL::action('Admin\UserController@trade',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 追踪</a>
                        <a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="{{$val['id']}}"><i class="layui-icon"></i> 删除</a>
                    </td>
                </tr>
            @empty
            @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $user->appends(['kw'=>$kw])->render(); ?>
    </div>
@endsection
@section('extendJs')
    <script type="text/javascript" src="{{ URL::asset('/js/admin/allUsers.js') }}"></script>

@endsection