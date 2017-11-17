@extends('layout.admin')
@section('extendCss')
@show
@section('title', '后台首页')
@section('content')
    <div class="container-fluid">

        <div class="side-body">
            <div class="page-title">
                <span class="title">用户管理</span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-title">
                                <div class="title">列表</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"/></th>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>状态</th>
                                    <th>类型</th>
                                    <th>注册时间</th>
                                    <th>注册IP</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($user))

                                    @forelse($user as $val)
                                    <tr>
                                        <th scope="row"><input type="checkbox"/></th>
                                        <td>{{$val['id']}}</td>
                                        <td>{{$val['username']}}</td>
                                        <td>{{$status[$val['status']]}}</td>

                                        <td>{{$val['modelid']}}</td>
                                        <td>{{date('Y-m-d H:i:s',$val['regdate'])}}</td>
                                        <td>{{$val['regip']}}</td>
                                        <td><a href="">编辑</a> |<a href="">删除</a></td>
                                    </tr>
                                @empty
                                @endforelse
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pad-wrapper" class="users-list">
                <div class="pagination pull-right">
                    <?php echo $user->render(); ?>
                </div>
                <!-- end users table -->
            </div>
        </div>
    </div>
@endsection
@section('extendJs')
    <script>
        $('.deluser').click(function(){
            var userid = $(this).attr('cid');
            $.post('{{url('/Admin/user/drop')}}',{userid:userid},function(data){
                if(data.status){
                    location.reload();
                }
            },'json')
        })
    </script>
@endsection