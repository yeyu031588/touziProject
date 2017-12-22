<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" data-toggle="modal" data-target="#myModal" >添加路由</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger" href="<?php echo e(url('/Admin/routeGroup')); ?>">分组管理</a>
        </div>
        <div class="layui-inline">
            <div class="layui-form-mid layui-word-aux"></div>
        </div>
    </blockquote>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加路由</h4>
                </div>
                <div class="modal-body">
                    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
                        <input type="hidden" value="" name="route_id"/>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">分组</label>
                                <div class="layui-input-block">
                                    <select name="group_id" class="userStatus" id="sgroup">
                                        <?php if(isset($group)): ?>

                                            <?php $__empty_1 = true; foreach($group as $val): $__empty_1 = false; ?>
                                                <option value="<?php echo e($val['id']); ?>" ><?php echo e($val['group']); ?></option>
                                            <?php endforeach; if ($__empty_1): ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="title">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">URL</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="url">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">类型</label>
                                <div class="layui-input-block">
                                    <select name="type" class="userStatus" id="stype">
                                        <option value="1">默认可见</option>
                                        <option value="0">默认不可见</option>
                                    </select>
                                </div>
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
            <tbody class="users_content">
            <tr>
                <td colspan="4"></td>
            </tr>
            <?php if(isset($group)): ?>

                <?php $__empty_1 = true; foreach($group as $val): $__empty_1 = false; ?>
                    <tr>
                        <td colspan="4" align="left"><?php echo e($val['group']); ?></td>
                    </tr>

                    <?php if(isset($val['urls'])): ?>

                        <?php $__empty_2 = true; foreach($val['urls'] as $value): $__empty_2 = false; ?>
                            <tr>
                                <td>---------|</td>
                                <td colspan="2">Title:<?php echo e($value['title']); ?>  URL:<?php echo e($value['url']); ?></td>
                                <td><a data-id="<?php echo e($value['route_id']); ?>" data-title="<?php echo e($value['title']); ?>" data-url="<?php echo e($value['url']); ?>" data-type="<?php echo e($value['type']); ?>" class="layui-btn layui-btn-mini" data-toggle="modal" data-target="#myModal"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($value['route_id']); ?>"><i class="layui-icon"></i> 删除</a></td>
                            </tr>
                        <?php endforeach; if ($__empty_2): ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                <?php endforeach; if ($__empty_1): ?>
                <?php endif; ?>
            <?php endif; ?>


            <?php if(isset($data)): ?>

                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>

                    <tr>
                        <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="<?php echo e($val['role_id']); ?>"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                        <td><?php echo e($val['role_name']); ?></td>
                        <td><?php echo e($status[$val['status']]); ?></td>
                        <td><a href="<?php echo URL::action('Admin\UserController@editRole',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 权限</a><a href="<?php echo URL::action('Admin\UserController@editRole',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($val['role_id']); ?>"><i class="layui-icon"></i> 删除</a></td>
                    </tr>
                    <tr>
                        <td>---------></td>
                        <td><?php echo e($val['role_name']); ?></td>
                        <td><?php echo e($status[$val['status']]); ?></td>
                        <td><a href="<?php echo URL::action('Admin\UserController@editRole',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 权限</a><a href="<?php echo URL::action('Admin\UserController@editRole',['id'=>$val['role_id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($val['role_id']); ?>"><i class="layui-icon"></i> 删除</a></td>
                    </tr>
                <?php endforeach; if ($__empty_1): ?>
                <?php endif; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
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
                    $.post('/Admin/dropRoute',{id:id},function(data){
                        if(data.status){
                            _this.parents("tr").remove();
                            layer.close(index);
                        }
                    },'json')

                });
            })


            $('#sub').click(function(){
                $.ajax({
                    type: 'post',
                    url: '/Admin/editRoute',
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

            $('#myModal').on('show.bs.modal', function (event) {
                var a = $(event.relatedTarget)
                var id = a.data('id'),title = a.data('title'),url = a.data('url'),type = a.data('type');
                if(id != 'undefined'){
//                    $("#sgroup").find("option").eq(2).attr("selected","selected")
                    $('input[name="title"]').val(title);
                    $('input[name="url"]').val(url);
                    $('input[name="route_id"]').val(id);
                }

            });


        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>