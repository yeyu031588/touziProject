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
            <form action="" id="searchForm" method="get">
                <div class="layui-input-inline">
                    <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" name="kw">
                </div>
                <a class="layui-btn search_btn">查询</a>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal usersAdd_btn">添加用户</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
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
                    <h4 class="modal-title" id="myModalLabel">分配会员</h4>
                </div>
                <div class="modal-body">
                    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
                        <input type="hidden" value="" name="userid"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label">会员</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="username">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">当前分配</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" value="" name="to">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">分配</label>
                                <div class="layui-input-block">
                                    <select name="admin_id" class="userStatus" id="stype">
                                        <option value="0" >取消</option>
                                        <?php if(isset($resource)): ?>
                                            <?php $__empty_1 = true; foreach($resource as $key=>$val): $__empty_1 = false; ?>
                                                <option value="<?php echo e(isset($val['userid']) ? $val['userid'] : ''); ?>" ><?php echo e(isset($val['username']) ? $val['username'] : ''); ?></option>
                                            <?php endforeach; if ($__empty_1): ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="place">分配</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <div class="layui-form users_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
                <th>登录名</th>
                <th>状态</th>
                <th>当前分配</th>
                <?php /*<th>注册IP</th>*/ ?>
                <th>备注</th>
                <th>来源</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="users_content">

            <?php if(isset($user)): ?>

            <?php $__empty_1 = true; foreach($user as $val): $__empty_1 = false; ?>

                <tr>
                    <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose" value="<?php echo e($val['id']); ?>"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                    <td><?php echo e($val['username']); ?></td>
                    <td <?php if($val['status']==0){echo 'style="color:red;"';}?>><?php echo e($status[$val['status']]); ?></td>
                    <td <?php if($val['to_id']==0){echo 'style="color:red;"';}?>><?php if($val['to_id']){echo $admin[$val['to_id']];}else{echo '暂未分配';}?></td>
                    <?php /*<td><?php echo e($val['regip']); ?></td>*/ ?>
                    <td><?php echo e($val['mark']); ?></td>
                    <td><?php if(isset($val['device']) && $val['device'] =='pc'): ?> 电脑 <?php endif; ?> <?php if(isset($val['device']) && $val['device'] =='mobile'): ?> 手机 <?php endif; ?></td>
                    <td><?php echo e(date('Y-m-d H:i:s',$val['regdate'])); ?></td>
                    <td>
                        <a href="<?php echo URL::action('Admin\UserController@profile',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-mini" data-toggle="modal" data-target="#myModal" data-userid="<?php echo e($val['id']); ?>" data-username="<?php echo e($val['username']); ?>" data-to="<?php echo e($val['to_id']); ?>"> 分配</a>
                        <a href="<?php echo URL::action('Admin\UserController@trade',['id'=>$val['id']]);?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 追踪</a>
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
        <?php echo $user->appends(['kw'=>$kw])->render(); ?>
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