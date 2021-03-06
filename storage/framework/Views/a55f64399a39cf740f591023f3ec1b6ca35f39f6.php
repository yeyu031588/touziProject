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
    <form class="layui-form" id='form' style="width:80%;" onsubmit="return false;">
        <input type="hidden" value="<?php echo e(isset($data['id']) ? $data['id'] : ''); ?>" name="id"/>

        <div class="layui-form-item">
            <label class="layui-form-label">投诉建议</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入备注信息" readonly class="layui-textarea"><?php echo e(isset($data['tousujianyi']) ? $data['tousujianyi'] : ''); ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系qq</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['qq']); ?>" readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">常用E-mail</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo e($data['email']); ?>" readonly>
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
                <button class="layui-btn" lay-submit="" lay-filter="addUser" id="sub">立即提交</button>
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
                    url: '/Admin/complaint/modify',
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