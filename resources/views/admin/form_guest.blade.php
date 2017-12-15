@extends('layout.admin')
@section('extendCss')
    <link rel="stylesheet" href="{{ URL::asset('/css/user.css') }}" media="all" />
@show
@section('title', '后台首页')
@section('content')
    {{--<blockquote class="layui-elem-quote news_search">--}}
        {{--<div class="layui-inline">--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">--}}
            {{--</div>--}}
            {{--<a class="layui-btn search_btn">查询</a>--}}
        {{--</div>--}}
        {{--<div class="layui-inline">--}}
            {{--<a class="layui-btn layui-btn-normal usersAdd_btn">添加用户</a>--}}
        {{--</div>--}}
        {{--<div class="layui-inline">--}}
            {{--<a class="layui-btn layui-btn-danger batchDel">批量删除</a>--}}
        {{--</div>--}}
        {{--<div class="layui-inline">--}}
            {{--<div class="layui-form-mid layui-word-aux"></div>--}}
        {{--</div>--}}
    {{--</blockquote>--}}
    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
                <th>ID</th>
                <th>状态</th>
                <th>发布人</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($user))

            @forelse($user as $val)

                <tr>
                    <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="{{$val['id']}}"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                    <td>{{$val['id']}}</td>
                    <td>{{$status[$val['status']]}}</td>
                    <td>{{$val['username']}}</td>
                    <td>{{date('Y-m-d H:i:s',$val['time'])}}</td>
                    <td><a href="<?php echo URL::action('Admin\SystemController@appointDetail',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="{{$val['id']}}"><i class="layui-icon"></i> 删除</a></td>
                </tr>
            @empty
            @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $user->render(); ?>
    </div>
@endsection
@section('extendJs')
    <script type="text/javascript" src="{{ URL::asset('/js/admin/allUsers.js') }}"></script>
@endsection