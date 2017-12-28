<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />
    <style>
        .layui-form-label{width: 100px;}
    </style>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
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

            <?php if(isset($data)): ?>

                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>

                    <tr>
                        <td><?php echo e($val['id']); ?></td>
                        <td><?php echo e($val['userid']); ?></td>
                        <td><a href="http://<?php echo e($val['url']); ?>" target="_blank">连接详情</a></td>
                        <td><?php echo e(str_limit($val['desc'], $limit = 20, $end = '...')); ?></td>
                        <td><?php echo e($val['ip']); ?></td>
                        <td><?php echo e(date('Y-m-d H:i:s',$val['time'])); ?></td>
                        <td><?php echo e($val['countNum']); ?></td>
                    </tr>
                <?php endforeach; if ($__empty_1): ?>
                <?php endif; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $data->appends(['id'=>$id])->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/admin/allUsers.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>