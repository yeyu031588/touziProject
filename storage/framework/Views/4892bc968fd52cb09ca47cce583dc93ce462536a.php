<?php $__env->startSection('extendCss'); ?>
    <?php /*<link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />*/ ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            当前角色：<a class="layui-btn layui-btn-danger"><?php echo e($role['role_name']); ?></a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" id="sub">确认</a>
        </div>
    </blockquote>
    <div class="layui-form users_list">
        <form action="" id="form">
            <input type="hidden" name="role_id" value="<?php echo e($role['role_id']); ?>"/>
            <table class="layui-table">
                <tbody class="users_content">
                <tr>
                    <td colspan="4"></td>
                </tr>
                <?php if(isset($group)): ?>

                    <?php $__empty_1 = true; foreach($group as $val): $__empty_1 = false; ?>
                        <tr>
                            <td colspan="4" align="left"><input type="checkbox"/><?php echo e($val['group']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="left">
                                <?php if(isset($val['urls'])): ?>

                                    <?php $__empty_2 = true; foreach($val['urls'] as $value): $__empty_2 = false; ?>
                                        <div style="width: 140px;" class="pull-left"> <input  type="checkbox" name="route[]" value="<?php echo e($value['route_id']); ?>" <?php if(in_array($value['route_id'],$permissions)){echo 'checked';}?> /><?php echo e($value['title']); ?></div>
                                    <?php endforeach; if ($__empty_2): ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>


                        <tr>
                            <td colspan="4"></td>
                        </tr>
                    <?php endforeach; if ($__empty_1): ?>
                    <?php endif; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </form>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>