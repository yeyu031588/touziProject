<!<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo e(URL::asset('/layui/css/layui.css')); ?>" media="all" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrap.min.css')); ?>" media="all" />
    <?php echo $__env->yieldContent('extendCss'); ?>
</head>
<body class="childrenBody">
<?php $__env->startSection('contenter'); ?>

<?php echo $__env->yieldContent('content'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery-1.11.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/layui/layui.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/js/anyupload.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/js/bootstrap.min.js')); ?>"></script>
<?php echo $__env->yieldContent('extendJs'); ?>
</body>
</html>