<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />
    <style>
        .layui-form-label{width: 100px;}
    </style>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <?php /*<div class="layui-inline">*/ ?>
            <?php /*<form action="" id="searchForm" method="get">*/ ?>
                <?php /*<div class="layui-input-inline">*/ ?>
                    <?php /*<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" name="kw">*/ ?>
                <?php /*</div>*/ ?>
                <?php /*<a class="layui-btn search_btn">查询</a>*/ ?>
            <?php /*</form>*/ ?>
        <?php /*</div>*/ ?>
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
                <th>Id</th>
                <th>状态</th>
                <th>发布人</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            <?php if(isset($data)): ?>

                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>

                    <tr>
                        <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="<?php echo e($val['id']); ?>"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                        <td><?php echo e($val['id']); ?></td>
                        <td <?php if($val['status']==0){echo 'style="color:red;"';}?>><?php echo e($status[$val['status']]); ?></td>
                        <td><?php if(!empty($val['username'])): ?> <?php echo e($val['username']); ?> <?php else: ?> <?php echo e($val['ip']); ?> <?php endif; ?></td>
                        <td><?php echo e(date('Y-m-d H:i:s',$val['time'])); ?></td>
                        <td>
                            <a href="<?php echo URL::action('Admin\SystemController@buttonAppDetail',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a>
                            <a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($val['id']); ?>"><i class="layui-icon"></i> 删除</a>
                        </td>
                    </tr>
                <?php endforeach; if ($__empty_1): ?>
                <?php endif; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $data->render(); ?>
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
                //if($(".search_input").val() != ''){
                $('#searchForm').submit();
                //var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
                //setTimeout(function(){
                //
                //    layer.close(index);
                //},2000);
                //}else{
                //    layer.msg("请输入需要查询的内容");
                //}
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
                                $.post('/Admin/buttonAppDrop',{id:$checked[j].value},function(data){
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



            $("body").on("click",".users_del",function(){  //删除
                var _this = $(this);
                layer.confirm('确定删除此用户？',{icon:3, title:'提示信息'},function(index){
                    var id = _this.attr("data-id");
                    $.post('/Admin/buttonAppDrop',{id:id},function(data){
                        if(data.status){
                            _this.parents("tr").remove();
                            layer.close(index);
                        }
                    },'json')

                });
            })


        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>