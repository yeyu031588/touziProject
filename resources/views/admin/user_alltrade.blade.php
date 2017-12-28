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
            <a class="layui-btn layui-btn-danger batchDel">访问报表</a>
        </div>
        <div class="layui-inline">
            <div class="layui-input-inline">
                <select name="status" lay-verify="required" class="layui-input search_input" style="width: 7em;" id="jumpd">
                    <option value="3" <?php if($d=='3')echo 'selected';?>>3</option>
                    <option value="5" <?php if($d=='5')echo 'selected';?>>5</option>
                    <option value="10" <?php if($d=='10')echo 'selected';?>>10</option>
                    <option value="15" <?php if($d=='15')echo 'selected';?>>15</option>
                </select>
            </div>
        </div>
    </blockquote>

    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>名称</th>
                <th>访问人次</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($data))

                @forelse($data as $val)

                    <tr>
                        <td>{{$val['id']}}</td>
                        <td><a href="http://{{$val['url']}}" target="_blank">连接详情</a></td>
                        <td>{{$val['desc']}}</td>
                        <td>{{$val['seeNum']}}</td>
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
        $('#jumpd').change(function(){
            self.location='?d='+$(this).val();
        })
    </script>
@endsection