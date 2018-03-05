<!DOCTYPE html>
<!-- saved from url=(0051)http://www.touzitop.com/member/index.php?c=register -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <title>中国新三板股权投资平台_第一股权网- 会员注册</title>

    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/home/login.css')); ?>" media="all" />

</head>
<body>
<div id="content">
    <div id="top">
        <div class="top">
            <div class="logo1"><a href="http://www.touzitop.com/" target="_blank"><img src="<?php echo e(URL::asset('/images/home/main_logo.png')); ?>" alt="" border="0"></a></div>
            <div class="iphone"> <img src="./home_files/phone.png" alt=""><a>咨询热线：400-805-4342</a> </div>
        </div>
    </div>
    <div id="contain1">
        <div class="contain1">
            <h1>注册第一股权网账户</h1>
            <p class="slogin">已有账户，<a href="http://www.touzitop.com/member/index.php?c=login">请登录</a></p>
            <form class="formreg" method="post" action="http://www.touzitop.com/member/index.php?c=register" name="myform" id="myform">
                <p class="pin">
                    <label>会员类型：</label>
                    <label class="pl"><input name="data[modelid]" required="" type="radio" value="5" checked="">个人投资者 </label>
                    <label class="pl"><input name="data[modelid]" required="" type="radio" value="14">企业投资者 </label>

                </p>
                <p class="pin1">
                    <label>用户名：</label>
                    <input type="text" class="username" placeholder="用户名" required="" id="txtUsername" name="data[username]">
                </p>
                <p class="pin1">
                    <label>设置密码：</label>
                    <input type="password" onkeyup="setPasswordLevel(this, document.getElementById(&#39;passwordLevel&#39;));" class="pwd" placeholder="密码（6-16位字符）" required="" id="txtPassword" name="data[password]">
                </p>
                <p class="pin1">
                    <label>确认密码：</label>
                    <input type="password" class="password_cf" placeholder="请再次输入密码" required="" maxlength="16" id="userpwdok" name="data[password2]">
                    <span id="_userpwdok"></span> </p>

                <p class="pin1 te2">
                    <label>手机号码：</label>
                    <input type="num" placeholder="请输入手机号" required="" id="tel" name="data[tel]">
                    <!--  <button id="zphone" type="button" class="huo"  onclick="send()">获取验证码</button>-->
                </p>
                <!--<p class="pin1 te1">
                  <label>手机验证码：</label>
                  <input class="yan" type="text" placeholder="请输入验证码" required id="mobile_code" name="mobile_code">
                </p>-->
                <div class="pin1">
                    <label>验证码：</label>
                    <input type="text" placeholder="请输入验证码" style=" width:100px; margin-right:20px; float:left;" id="vdcode" name="code">
                    <p class="top15 captcha" id="captcha-container"> <img id="code" src="./home_files/index.php" align="absmiddle" title="看不清楚？换一张" onclick="document.getElementById(&#39;code&#39;).src=&#39;../index.php?c=api&amp;a=checkcode&amp;width=100&amp;height=30&amp;&#39;+Math.random();" style="cursor:pointer; margin-top:-3px;"> </p>
                </div>

                <!--    <p class="pin1 te1">
                    <label>手机验证码：</label>
                    <input class="yan"  type="text" placeholder="请输入验证码" required id="mobile_code" name="mobile_code">
                  </p>-->
                <div class="aggree">
                    <input type="checkbox" checked="checked" id="agree" onblur="">
                    我已阅读并同意《用户协议》</div>
                <input type="submit" id="btnSignCheck" class="lsubmit1" value="提交注册">
                <!--短信宝  start-->
                <script type="text/javascript">
                    $("#zphone").click(function(){
                        if($("#tel").val() == ""){
                            alert("手机号不能为空！");return false;
                        }
                        if (!/^1[34578]\d{9}$/i.test($("#tel").val())) {
                            alert("手机号码不2对,请正确填写");return false;
                        }

                    });

                </script>
                <!--短信宝  end-->
            </form>
        </div>
    </div>
</div>
<!--主体结束-->
<!--底部-->
<div id="footer">
    <div class="footer">
        <div class="footerB"> <span>Copyright © touzitop.com.com. 第一股权网 版权所有</span> </div>
    </div>
</div>

</body></html>