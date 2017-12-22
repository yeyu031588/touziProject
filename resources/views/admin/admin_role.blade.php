@extends('layout.admin')
@section('extendCss')
    <link rel="stylesheet" href="{{ URL::asset('/css/user.css') }}" media="all" />
@show
@section('title', '后台首页')
@section('content')
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" href="{{url('/Admin/editRole')}}">添加角色</a>
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
                <th>角色</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            @if (isset($data))

                @forelse($data as $val)

                    <tr>
                        <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="{{$val['role_id']}}"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                        <td>{{$val['role_name']}}</td>
                        <td>{{$status[$val['status']]}}</td>
                        <td><a href="<?php echo URL::action('Admin\RouteController@permissions',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 权限</a><a href="<?php echo URL::action('Admin\UserController@editRole',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="{{$val['role_id']}}"><i class="layui-icon"></i> 删除</a></td>
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
        }).use(['form','layer','jquery','laypage'],function(){
            var form = layui.form(),
                    layer = parent.layer === undefined ? layui.layer : parent.layer,
                    laypage = layui.laypage,
                    $ = layui.jquery;


            //查询
            $(".search_btn").click(function(){
                var userArray = [];
                if($(".search_input").val() != ''){
                    var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
                }else{
                    layer.msg("请输入需要查询的内容");
                }
            })


            //批量删除
            $(".batchDel").click(function(){
                var $checkbox = $('.users_list tbody input[type="checkbox"][name="checked"]');
                var $checked = $('.users_list tbody input[type="checkbox"][name="checked"]:checked');
                if($checkbox.is(":checked")){
                    layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
                        var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
                        setTimeout(function(){
                            //删除数据

                            for(var j=0;j<$checked.length;j++){
                                $.post('/Admin/dropRole',{role_id:$checked[j].value},function(data){
                                    if(data.status){
                                        _this.parents("tr").remove();
                                        layer.close(index);
                                    }
                                },'json')
                            }
                            $('.users_list thead input[type="checkbox"]').prop("checked",false);
                            form.render();
                            layer.close(index);
                            layer.msg("删除成功");
                            location.reload();

                        },2000);
                    })
                }else{
                    layer.msg("请选择需要删除的文章");
                }
            })

            //全选
            form.on('checkbox(allChoose)', function(data){
                var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
                child.each(function(index, item){
                    item.checked = data.elem.checked;
                });
                form.render('checkbox');
            });

            //通过判断文章是否全部选中来确定全选按钮是否选中
            form.on("checkbox(choose)",function(data){
                var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
                var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
                if(childChecked.length == child.length){
                    $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
                }else{
                    $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
                }
                form.render('checkbox');
            })

            //操作
            $("body").on("click",".users_edit",function(){  //编辑
                layer.alert('您点击了会员编辑按钮，由于是纯静态页面，所以暂时不存在编辑内容，后期会添加，敬请谅解。。。',{icon:6, title:'文章编辑'});
            })

            $("body").on("click",".users_del",function(){  //删除
                var _this = $(this);
                layer.confirm('确定删除此用户？',{icon:3, title:'提示信息'},function(index){
                    var id = _this.attr("data-id");
                    $.post('/Admin/dropRole',{role_id:id},function(data){
                        if(data.status){
                            _this.parents("tr").remove();
                            layer.close(index);
                        }
                    },'json')

                });
            })


        })
    </script>
@endsection