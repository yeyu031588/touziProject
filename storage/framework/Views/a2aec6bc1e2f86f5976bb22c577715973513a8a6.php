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

            <?php if(isset($data)): ?>

                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>

                    <tr>
                        <td><?php echo e($val['id']); ?></td>
                        <td><a href="http://<?php echo e($val['url']); ?>" target="_blank">连接详情</a></td>
                        <td><?php echo e($val['desc']); ?></td>
                        <td><?php echo e($val['seeNum']); ?></td>
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
        $('#jumpd').change(function(){
            self.location='?d='+$(this).val();
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>