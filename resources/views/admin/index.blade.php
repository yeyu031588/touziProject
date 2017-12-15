<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>第一股权网 - 后台管理中心 </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset('/layui/css/font_tnyc012u2rlwstt9.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('/layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('/css/main.css') }}" media="all" />
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main">
            <a href="#" class="logo">后台管理界面</a>
            <!-- 显示/隐藏菜单 -->
            <a href="javascript:;" class="iconfont hideMenu icon-menu1"></a>
            <!-- 搜索 -->
            <!--
            <div class="layui-form component">
                <select name="modules" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    <option value="1">layer</option>
                    <option value="2">form</option>
                    <option value="3">layim</option>
                    <option value="4">element</option>
                    <option value="5">laytpl</option>
                    <option value="6">upload</option>
                    <option value="7">laydate</option>
                    <option value="8">laypage</option>
                    <option value="9">flow</option>
                    <option value="10">util</option>
                    <option value="11">code</option>
                    <option value="12">tree</option>
                    <option value="13">layedit</option>
                    <option value="14">nav</option>
                    <option value="15">tab</option>
                    <option value="16">table</option>
                    <option value="17">select</option>
                    <option value="18">checkbox</option>
                    <option value="19">switch</option>
                    <option value="20">radio</option>
                </select>
                <i class="layui-icon">&#xe615;</i>
            </div>-->
            <!-- 天气信息 -->
            <!--
           <div class="weather" pc>
               <div id="tp-weather-widget"></div>
               <script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
               <script>tpwidget("init", {
                   "flavor": "slim",
                   "location": "WX4FBXXFKE4F",
                   "geolocation": "enabled",
                   "language": "zh-chs",
                   "unit": "c",
                   "theme": "chameleon",
                   "container": "tp-weather-widget",
                   "bubble": "disabled",
                   "alarmType": "badge",
                   "color": "#FFFFFF",
                   "uid": "U9EC08A15F",
                   "hash": "039da28f5581f4bcb5c799fb4cdfb673"
               });
               tpwidget("show");</script>
           </div>-->
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <!--
                <li class="layui-nav-item showNotice" id="showNotice" pc>
                    <a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
                </li>-->
                <li class="layui-nav-item" mobile>
                    <a href="javascript:;" class="mobileAddTab" data-url="page/user/changePwd.html"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>设置</cite></a>
                </li>
                <li class="layui-nav-item" mobile>
                    <a href="page/login/login.html" class="signOut"><i class="iconfont icon-loginout"></i> 退出</a>
                </li>
                <!--
                <li class="layui-nav-item lockcms" pc>
                    <a href="javascript:;"><i class="iconfont icon-lock1"></i><cite>锁屏</cite></a>
                </li>-->
                <li class="layui-nav-item" pc>
                    <a href="javascript:;">
                        <img src="images/face.jpg" class="layui-circle" width="35" height="35">
                        <cite>admin</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <!-- <dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>个人资料</cite></a></dd>-->
                        <dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>修改密码</cite></a></dd>
                        <dd><a href="javascript:;" class="changeSkin"><i class="iconfont icon-huanfu"></i><cite>更换皮肤</cite></a></dd>
                        <dd><a href="{{url('/Admin/layout')}}" class="signOut"><i class="iconfont icon-loginout"></i><cite>退出</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        <div class="user-photo">
            <a class="img" title="我的头像" ><img src="images/face.jpg"></a>
            <p>你好！<span class="userName">admin</span>, 欢迎登录 </p>
        </div>
        <div class="navBar layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item"><a href="javascript:;" data-url="page/main.html"><i class="layui-icon">&#xe623;</i>   <cite>后台首页</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" ><i class="layui-icon">&#xe623;</i><cite>管理员管理</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="{{url('/Admin/adminuser')}}">
                                <cite>管理员</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/user/registerCount')}}">
                                <cite>权限</cite></a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="javascript:;" ><i class="layui-icon">&#xe623;</i><cite>会员管理</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="{{url('/Admin/user')}}">
                                <cite>会员列表</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/user/registerCount')}}">
                                <cite>会员统计</cite></a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/1')}}"><i class="layui-icon">&#xe623;</i> <cite>股权项目</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/26')}}"><i class="layui-icon">&#xe623;</i> <cite>专题栏目</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/3')}}"><i class="layui-icon">&#xe623;</i><cite>三板资讯</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/8')}}">
                                <cite>三板头条</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/9')}}">
                                <cite>行业解析</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/10')}}">
                                <cite>政策解读</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/11')}}">
                                <cite>大咖访谈</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/12')}}">
                                <cite>学堂</cite></a></dd>
                    </dl></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/4')}}"><i class="layui-icon">&#xe623;</i><cite>原创研究</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/13')}}">
                                <cite>三板调研</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/14')}}">
                                <cite>机构观点</cite></a></dd>
                        <dd><a href="javascript:;"data-url="{{url('/Admin/content/list/15')}}" >
                                <cite>项目分析</cite></a></dd>
                    </dl></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/5')}}"><i class="layui-icon">&#xe623;</i> <cite>视频中心</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/6')}}"><i class="layui-icon">&#xe623;</i> <cite>行情中心</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/16')}}"><i class="layui-icon">&#xe623;</i><cite>投资咨询</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/17')}}">
                                <cite>投资要闻</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/18')}}">
                                <cite>投资走向</cite></a></dd>
                        <dd><a href="javascript:;" data-url="{{url('/Admin/content/list/19')}}">
                                <cite>投资百科</cite></a></dd>
                    </dl></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/33')}}"><i class="layui-icon">&#xe623;</i> <cite>企业专栏</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/content/list/34')}}"><i class="layui-icon">&#xe623;</i> <cite>搜索栏目</cite></a></li>

                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/onlineAppointment')}}"><i class="layui-icon">&#xe623;</i>   <cite>在线预约</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/commentList')}}"><i class="layui-icon">&#xe623;</i>   <cite>文章评论</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/complaint')}}"><i class="layui-icon">&#xe623;</i>   <cite>投诉建议</cite></a></li>
                <li class="layui-nav-item"><a href="javascript:;" data-url="{{url('/Admin/buttonAppointment')}}"><i class="layui-icon">&#xe623;</i>   <cite>底部预约</cite></a></li>
                <span class="layui-nav-bar" ></span>
            </ul>

        </div>




        <!--<div class="navBar layui-side-scroll"></div>-->
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab marg0" lay-filter="bodyTab" id="top_tabs_box">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i> <cite>后台首页</cite></li>
            </ul>
            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="iconfont icon-caozuo"></i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" class="closePageOther"><i class="iconfont icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" class="closePageAll"><i class="iconfont icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe src="{{url('/Admin/main')}}"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="layui-footer footer">
        <p> 上海投鼎资产管理有限公司</p>
    </div>
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>
<script type="text/javascript" src="{{ URL::asset('/js/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/layui/layui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/leftNav.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/index.js') }}"></script>
</body>
</html>