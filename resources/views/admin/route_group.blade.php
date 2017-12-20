@extends('layout.admin')
@section('extendCss')
    <link rel="stylesheet" href="{{ URL::asset('/css/user.css') }}" media="all" />
@show
@section('title', '后台首页')
@section('content')
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal " href="{{url('/Admin/route')}}">返回路由</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-dangerl" data-toggle="modal" data-target="#myModal">添加分组</a>
        </div>
        <div class="layui-inline">
            <div class="layui-form-mid layui-word-aux"></div>
        </div>
    </blockquote>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加分组</h4>
                </div>
                <div class="modal-body">
                    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
                        <div class="layui-form-item">
                            <label class="layui-form-label">ID</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="{{$data['id'] or ''}}" name="group_id" readonly>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">组名</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="{{$data['group'] or ''}}" name="group">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="sub">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>分组</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($data))

                @forelse($data as $val)

                    <tr>
                        <td>{{$val['id']}}</td>
                        <td>{{$val['group']}}</td>
                        <td><a data-id="{{$val['id']}}" data-group="{{$val['group']}}" class="layui-btn layui-btn-mini" data-toggle="modal" data-target="#myModal"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="{{$val['id']}}"><i class="layui-icon"></i> 删除</a></td>
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
                    url: '/Admin/editGroup',
                    data: $("#form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if(data.status == '200'){
                            layer.msg("编辑成功");
                            location.reload();
                        }
                    }
                })
            })


        })


        $('#myModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var id = a.data('id'),group = a.data('group');
            if(id != 'undefined'){
                $('input[name="group_id"]').val(id);
                $('input[name="group"]').val(group);
            }

        });

    </script>
@endsection