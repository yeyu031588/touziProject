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
    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
        <input type="hidden" value="<?php echo e($data['id']); ?>" name="id"/>
        <input type="hidden" value="<?php echo e($data['modelid']); ?>" name="modelid"/>
        <div class="layui-form-item">
            <label class="layui-form-label">会员名</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['username']); ?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">归属</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input"  value="<?php if($data['modelid'] == 5){echo '个人投资者';}else{echo '机构投资者';}?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['email']); ?>" name="email">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" placeholder="请输入邮箱" name="password">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册时间</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e(date('Y-m-d H:i:s',$data['regdate'])); ?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册IP</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['regip']); ?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <select name="status" class="userStatus">
                        <option value="1" <?php if($data['status']==1)echo 'selected';?>>审核</option>
                        <option value="0" <?php if($data['status']==0)echo 'selected';?>>未审核</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['mobile']); ?>" name="mobile">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入备注信息" name="mark" class="layui-textarea"><?php echo e($data['mark']); ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addUser" id="sub">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/admin/addUser.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>