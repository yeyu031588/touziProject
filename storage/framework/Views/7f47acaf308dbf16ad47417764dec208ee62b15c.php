<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录--layui后台管理模板</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/css/login.css" media="all" />
</head>
<body>
<video class="video-player" preload="auto" autoplay="autoplay" loop="loop" data-height="1080" data-width="1920" height="1080" width="1920">
    <source src="login.mp4" type="video/mp4">
    <!-- 此视频文件为支付宝所有，在此仅供样式参考，如用到商业用途，请自行更换为其他视频或图片，否则造成的任何问题使用者本人承担，谢谢 -->
</video>
<div class="video_mask"></div>
<div class="login">
    <h1>投鼎-管理登录</h1>
    <form class="layui-form" action="<?php echo e(url('/AdminLogin')); ?>" method="post">
        <div class="layui-form-item">
            <input class="layui-input" name="name" placeholder="用户名" lay-verify="required" type="text" autocomplete="off">
        </div>
        <div class="layui-form-item">
            <input class="layui-input" name="password" placeholder="密码" lay-verify="required" type="password" autocomplete="off">
        </div>
        <?php /*<div class="layui-form-item form_code">*/ ?>
            <?php /*<input class="layui-input" name="code" placeholder="验证码" lay-verify="required" type="text" autocomplete="off">*/ ?>
            <?php /*<div class="code"><img src="../../images/code.jpg" width="116" height="36"></div>*/ ?>
        <?php /*</div>*/ ?>
        <button class="layui-btn login_btn" lay-submit="" lay-filter="login">登录</button>
    </form>
</div>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="login.js"></script>
</body>
</html>