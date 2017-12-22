@extends('layout.admin')
@section('extendCss')
    {{--<link rel="stylesheet" href="{{ URL::asset('/css/user.css') }}" media="all" />--}}
@show
@section('title', '后台首页')
@section('content')
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            当前角色：<a class="layui-btn layui-btn-danger">{{$role['role_name']}}</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" id="sub">确认</a>
        </div>
    </blockquote>
    <div class="layui-form users_list">
        <form action="" id="form">
            <input type="hidden" name="role_id" value="{{$role['role_id']}}"/>
            <table class="layui-table">
                <tbody class="users_content">
                <tr>
                    <td colspan="4"></td>
                </tr>
                @if (isset($group))

                    @forelse($group as $val)
                        <tr>
                            <td colspan="4" align="left"><input type="checkbox"/>{{$val['group']}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="left">
                                @if (isset($val['urls']))

                                    @forelse($val['urls'] as $value)
                                        <div style="width: 140px;" class="pull-left"> <input  type="checkbox" name="route[]" value="{{$value['route_id']}}" <?php if(in_array($value['route_id'],$permissions)){echo 'checked';}?> />{{$value['title']}}</div>
                                    @empty
                                    @endforelse
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <td colspan="4"></td>
                        </tr>
                    @empty
                    @endforelse
                @endif

                </tbody>
            </table>
        </form>
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


            $('#sub').click(function(){
                $.ajax({
                    type: 'post',
                    url: '/Admin/rolePremission',
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