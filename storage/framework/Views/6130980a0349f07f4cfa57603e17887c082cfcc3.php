<?php $__env->startSection('extendCss'); ?>
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }
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
                        <option value="1" <?php if(isset($data) && $data['role']==1)echo 'selected';?>>业务员</option>
                        <option value="2" <?php if(isset($data) && $data['role']==2)echo 'selected';?>>编辑</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" placeholder="请输入密码" value="<?php echo e(isset($data['password']) ? $data['password'] : ''); ?>" name="password">
            </div>
        </div>

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
                        }
                    }
                })
            })


        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>