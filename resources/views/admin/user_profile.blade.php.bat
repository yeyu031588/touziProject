@extends('layout.admin')
@section('extendCss')

@show

@section('title', '后台首页')
@section('content')
    <div class="container-fluid pull-left col-sm-6">
        <div class="side-body">
            <div class="page-title">
            <span class="title">用户管理</span>
            </div>
            <div class="user-form">
                <form class="form-horizontal" method="post" action="{{url('/Admin/user/modify')}}">
                    <input type="hidden" name="id" value="{{$data['id']}}"/>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="" placeholder="用户名" value="{{$data['username']}}" name="username" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="密码" value="{{$data['password']}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="邮箱" value="{{$data['email']}}" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">手机号</label>
                        <div class="col-sm-6">
                            <input type="mobile" class="form-control" id="mobile" placeholder="手机号" value="{{$data['mobile']}}" name="mobile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">注册时间</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="注册时间" value="{{$data['regdate']}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">注册IP</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$data['regip']}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-6">
                            <input type="radio" name="status" <?php if($data['status']==1)echo 'checked';?> value="1"> 审核
                            <input type="radio" name="status" <?php if($data['status']==0)echo 'checked';?> value="0"> 未审核
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-default">保 存</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endsection
@section('extendJs')
    <script>

    </script>
@endsection