<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/user.css')); ?>" media="all" />
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <?php /*<blockquote class="layui-elem-quote news_search">*/ ?>
        <?php /*<div class="layui-inline">*/ ?>
            <?php /*<div class="layui-input-inline">*/ ?>
                <?php /*<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">*/ ?>
            <?php /*</div>*/ ?>
            <?php /*<a class="layui-btn search_btn">查询</a>*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<div class="layui-inline">*/ ?>
            <?php /*<a class="layui-btn layui-btn-normal usersAdd_btn">添加用户</a>*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<div class="layui-inline">*/ ?>
            <?php /*<a class="layui-btn layui-btn-danger batchDel">批量删除</a>*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<div class="layui-inline">*/ ?>
            <?php /*<div class="layui-form-mid layui-word-aux"></div>*/ ?>
        <?php /*</div>*/ ?>
    <?php /*</blockquote>*/ ?>
    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
                <th>ID</th>
                <th>状态</th>
                <th>发布人</th>
                <th>手机号</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            <?php if(isset($user)): ?>

            <?php $__empty_1 = true; foreach($user as $val): $__empty_1 = false; ?>

                <tr>
                    <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="<?php echo e($val['id']); ?>"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                    <td><?php echo e($val['id']); ?></td>
                    <td><?php echo e($status[$val['status']]); ?></td>
                    <td><?php echo e($val['username']); ?></td>
                    <td><?php echo e($val['tel']); ?></td>
                    <td><?php echo e(date('Y-m-d H:i:s',$val['time'])); ?></td>
                    <td><a href="<?php echo URL::action('Admin\SystemController@appointDetail',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="<?php echo e($val['id']); ?>"><i class="layui-icon"></i> 删除</a></td>
                </tr>
            <?php endforeach; if ($__empty_1): ?>
            <?php endif; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $user->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/admin/allUsers.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>