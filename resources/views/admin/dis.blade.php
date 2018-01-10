@extends('layout.admin')
@section('extendCss')
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }
        .layui-form-label{width: 110px;}
    </style>
@show

@section('title', '分配会员')
@section('content')
    <div class="layui-layer-title" style="cursor: move;"><a href="{{url('/Admin/user')}}">返回</a></div>

    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
        <input type="hidden" value="{{$data['id']}}" name="userid"/>
        <input type="hidden" value="{{$data['to_id']}}" name="admin"/>
        <div class="layui-form-item">
            <label class="layui-form-label">会员</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" readonly value="{{$data['username'] or ''}}" name="username">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">当前分配</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" readonly value="<?php if($data['to_id']){echo $admin[$data['to_id']];}else{echo '暂未分配';}?>" name="to">
            </div>
        </div>
        {{--@if (isset($data['to_id']) && $data['to_id'])--}}
            {{--<div class="layui-form-item dis">--}}
                {{--<label class="layui-form-label">重新分配</label>--}}
                {{--<div class="layui-input-block">--}}
                    {{--<input type="checkbox" name="dis" value="1" title="确认" id="ch" >--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}

        <div class="layui-form-item choice">
            <div class="layui-inline">
                <label class="layui-form-label">
                    @if (isset($data['to_id']) && $data['to_id'])
                        重新选择
                        @else
                        选择
                    @endif</label>
                <div class="layui-input-block">
                    <select name="admin_id" class="userStatus" id="stype">
                        <option value="-1" >选择</option>
                        @if (isset($data['to_id']) && $data['to_id'])
                            <option value="0" >取消</option>

                        @endif
                        @if (isset($resource))
                            @forelse($resource as $key=>$val)
                                <option value="{{$val['userid'] or ''}}" >{{$val['username'] or ''}}</option>
                            @empty
                            @endforelse
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item but">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addUser" id="sub">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <hr/>
    历史分配纪录:
    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>

            </thead>
            <tbody class="users_content">

            @if (isset($log))

                @forelse($log as $val)

                    <tr>
                        @if ($val['status']==1)
                            <td>ID-{{$val['id']}} 分配消息：会员【{{$data['username']}}】{{date('Y-m-d H:i:s',$val['time'])}} 从【<?php if($val['last_id']){echo $admin[$val['last_id']];}else{echo '系统';}?>】 分配给【{{$admin[$val['admin_id']]}}】</td>
                        @else
                            <td>ID-{{$val['id']}} 分配消息：会员【{{$data['username']}}】{{date('Y-m-d H:i:s',$val['time'])}} 从【{{$admin[$val['last_id']]}}】 撤回到【系统】</td>

                        @endif
                    </tr>
                @empty
                @endforelse
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('extendJs')
    <script>
        layui.config({
            base : "js/"
        }).use(['form','layer','jquery','layedit','laydate'],function(){
            var form = layui.form(),
                    layer = parent.layer === undefined ? layui.layer : parent.layer,
                    laypage = layui.laypage,
                    layedit = layui.layedit,
                    laydate = layui.laydate,
                    $ = layui.jquery;

            $('#sub').click(function(){
                $.ajax({
                    type: 'post',
                    url: '/Admin/user/distribution',
                    data: $("#form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if(data.status == '200'){
                            layer.msg("编辑成功");
                            location.reload();
                        }else{
                            layer.msg(data.msg);

                        }
                    }
                })
            })


        })


    </script>

@endsection