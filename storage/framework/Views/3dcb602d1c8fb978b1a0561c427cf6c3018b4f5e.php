<?php $__env->startSection('extendCss'); ?>
    <style>
        .layui-form-label{width: 110px;}
        .newsName{width: 400px;}
        .layui-textarea{width: 800px;}
    </style>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '股权项目'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-layer-title" style="cursor: move;"><a href="javascript:window.history.go(-1);">返回</a></div>
    <form class="layui-form" id='form' method="post" onsubmit="return false;">
        <input type="hidden" name="id" value="<?php echo e($data['id']); ?>"/>
        <input type="hidden" name="cid" value="<?php echo e($data['catid']); ?>"/>
        <div class="layui-form-item">
            <label class="layui-form-label">栏目</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select class="select" name="data[catid]">
                        <option value="<?php echo e($data['catid']); ?>" selected=""> <?php echo e($cate[$data['catid']]); ?></option>
                        <option value="35"> 测试</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="data[title]" class="layui-input newsName" lay-verify="required" value="<?php echo e(isset($data['title']) ? $data['title'] : ''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缩略图</label>
            <div class="layui-input-block">
                <input type="text" name="data[thumb]" class="layui-input newsName imgs" value="<?php echo e(isset($data['thumb']) ? $data['thumb'] : ''); ?>"><span class="up">上传</span>

            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="data[keywords]" class="layui-input newsName" value="<?php echo e(isset($data['keywords']) ? $data['keywords'] : ''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容摘要" name="data[description]" class="layui-textarea"><?php echo e(isset($data['description']) ? $data['description'] : ''); ?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <script id="content" name="content" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['content']))echo htmlspecialchars_decode($data['content']);
                    ?>
                </script>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="data[status]" title="正常" value="1" <?php if($data['status']=='1')echo 'checked';?>/>
                <input type="radio" name="data[status]" title="头条" value="2" <?php if($data['status']=='2')echo 'checked';?>/>
                <input type="radio" name="data[status]" title="推荐" value="3" <?php if($data['status']=='3')echo 'checked';?>/>
                <input type="radio" name="data[status]" title="未审核" value="0" <?php if($data['status']=='0' || !$data['status'])echo 'checked';?>/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">首页图片</label>
            <div class="layui-input-block">
                <input type="text" name="data[stu]" class="layui-input newsName imgs" value="<?php echo e(isset($data['stu']) ? $data['stu'] : ''); ?>"><span class="up">上传</span>

            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[time]" id="form_datetime_1" value="<?php echo date('Y-m-d H:i:s',$data['time']);?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">阅读数</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[hits]" value="<?php echo e(isset($data['hits']) ? $data['hits'] : ''); ?>">
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addNews" id="sub">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
    <script type="text/javascript" src="/js/admin/newsAdd.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <script src="<?php echo e(URL::asset('/js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/bootstrap-datetimepicker.zh-CN.js')); ?>"></script>
    <script type="text/javascript">
    </script>
    <script>
        $(function(){
            $(".up").Upload({
                formData:{
                    type:'image',
                    _token:'<?php echo e(csrf_token()); ?>'
                },
                url:'<?php echo e(url("/uploadImg")); ?>',
                completed:function(en,data){
                    if(data.status){
                        en.parent().find('.imgs').val(data.url);
                    }
                }
            });

        })
    </script>

    <script>
        $("#form_datetime_1").datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd hh:ii:ss',
            autoclose: true,
            todayBtn: true,
            startView: 'month',
            minView:'month',
            maxView:'decade'
        });;

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>