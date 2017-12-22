<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal " href="<?php echo e(url('/Admin/route')); ?>">返回路由</a>
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
                                <input type="text" class="layui-input" value="" name="group_id" readonly>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="sort">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">组名</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="group">
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
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            <?php if(isset($data)): ?>

                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>

                    <tr>
                        <td><?php echo e($val['id']); ?></td>
                        <td><?php echo e($val['group']); ?></td>
                        <td><?php echo e($val['sort']); ?></td>
                        <td><a data-id="<?php echo e($val['id']); ?>" data-sort="<?php echo e($val['sort']); ?>" data-group="<?php echo e($val['group']); ?>" class="layui-btn layui-btn-mini" data-toggle="modal" data-target="#myModal"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($val['id']); ?>"><i class="layui-icon"></i> 删除</a></td>
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
                        }else{
                            layer.msg(data.msg);

                        }
                    }
                })
            })


        })

        $("body").on("click",".users_del",function(){  //删除
            var _this = $(this);
            layer.confirm('确定删除此分组？',{icon:3, title:'提示信息'},function(index){
                var id = _this.attr("data-id");
                $.post('/Admin/dropGroup',{id:id},function(data){
                    if(data.status){
                        _this.parents("tr").remove();
                        layer.close(index);
                    }
                },'json')

            });
        })

        $('#myModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var id = a.data('id'),group = a.data('group'),sort = a.data('sort');
            if(id != 'undefined'){
                $('input[name="group_id"]').val(id);
                $('input[name="group"]').val(group);
                $('input[name="sort"]').val(sort);
            }

        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>