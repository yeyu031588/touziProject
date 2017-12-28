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
            <a class="layui-btn layui-btn-danger batchDel">访问记录</a>
        </div>
    </blockquote>

    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>URL</th>
                <th>说明</th>
                <th>访问IP</th>
                <th>刷新时间</th>
                <th>次数</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($data))

                @forelse($data as $val)

                    <tr>
                        <td>{{$val['id']}}</td>
                        <td>{{$val['userid']}}</td>
                        <td><a href="http://{{$val['url']}}" target="_blank">连接详情</a></td>
                        <td>{{str_limit($val['desc'], $limit = 20, $end = '...')}}</td>
                        <td>{{$val['ip']}}</td>
                        <td>{{date('Y-m-d H:i:s',$val['time'])}}</td>
                        <td>{{$val['countNum']}}</td>
                    </tr>
                @empty
                @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $data->appends(['id'=>$id])->render(); ?>
    </div>
@endsection
@section('extendJs')
    <script type="text/javascript" src="{{ URL::asset('/js/admin/allUsers.js') }}"></script>
    <script>
        $('#myModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var userid = a.data('userid'),username = a.data('username'),to = a.data('to');
            if(userid != 'undefined'){
                $('input[name="userid"]').val(userid);
                $('input[name="username"]').val(username);
                $('input[name="to"]').val(to);
            }

        });

        //分配
        $('#place').click(function(){
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
    </script>
@endsection