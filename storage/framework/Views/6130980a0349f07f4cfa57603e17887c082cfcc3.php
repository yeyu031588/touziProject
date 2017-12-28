<?php $__env->startSection('extendCss'); ?>
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }
        .layui-form-label{width: 100px;}
    </style>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('title', '后台首页'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-layer-title" style="cursor: move;"><a href="javascript:window.history.go(-1);">返回</a></div>
    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
        <input type="hidden" value="<?php echo e(isset($data['userid']) ? $data['userid'] : ''); ?>" name="id"/>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e(isset($data['username']) ? $data['username'] : ''); ?>" name="username">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">角色</label>
                <div class="layui-input-block">
                    <select name="role" class="userStatus">
                        <?php if(isset($role)): ?>

                            <?php $__empty_1 = true; foreach($role as $key=>$val): $__empty_1 = false; ?>
                                <option value="<?php echo e(isset($val['role_id']) ? $val['role_id'] : ''); ?>" ><?php echo e(isset($val['role_name']) ? $val['role_name'] : ''); ?></option>
                            <?php endforeach; if ($__empty_1): ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <?php if(!isset($data)): ?>

            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" placeholder="请输入密码" value="<?php echo e(isset($data['password']) ? $data['password'] : ''); ?>" name="password">
                </div>
            </div>
        <?php endif; ?>
        <?php if(isset($data)): ?>

            <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" placeholder="请输入密码" value="" name="repassword">
                </div>
            </div>
        <?php endif; ?>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <select name="status" class="userStatus">
                        <option value="1" <?php if(isset($data) && $data['status']==1)echo 'selected';?>>审核</option>
                        <option value="0" <?php if(isset($data) && $data['status']==0)echo 'selected';?>>未审核</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">超级管理</label>
                <div class="layui-input-block">
                    <select name="is_admin" class="userStatus">
                        <option value="0" <?php if(isset($data) && $data['is_admin']==0)echo 'selected';?>>否</option>
                        <option value="1" <?php if(isset($data) && $data['is_admin']==1)echo 'selected';?>>是</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">会员分配</label>
                <div class="layui-input-block">
                    <select name="is_resource" class="userStatus">
                        <option value="0" <?php if(isset($data) && $data['is_resource']==0)echo 'selected';?>>无</option>
                        <option value="1" <?php if(isset($data) && $data['is_resource']==1)echo 'selected';?>>有</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addUser" id="sub">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

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
                    url: '/Admin/adminmodify',
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