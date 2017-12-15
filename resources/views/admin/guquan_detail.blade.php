@extends('layout.admin')
@section('extendCss')
    <style>
        .layui-form-label{width: 110px;}
        .newsName{width: 400px;}
        .layui-textarea{width: 800px;}
    </style>
@show
@section('title', '股权项目')
@section('content')
    <div class="layui-layer-title" style="cursor: move;"><a href="javascript:window.history.go(-1);">返回</a></div>
    <form class="layui-form" id='form' method="post" onsubmit="return false;">
        <input type="hidden" name="id" value="{{$data['id'] or ''}}"/>
        <input type="hidden" name="cid" value="{{$data['catid']}}"/>
        <div class="layui-form-item">
            <label class="layui-form-label">栏目</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select class="select" name="data[catid]">
                        <option value="{{$data['catid']}}" selected=""> {{$cate[$data['catid']]}}</option>
                        <option value="35"> 测试</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="data[title]" class="layui-input newsName" lay-verify="required" value="{{$data['title'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缩略图</label>
            <div class="layui-input-block">
                <input type="text" name="data[thumb]" class="layui-input newsName imgs" value="{{$data['thumb'] or ''}}"><span class="up">上传</span>

            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="data[keywords]" class="layui-input newsName" value="{{$data['keywords'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容摘要" name="data[description]" class="layui-textarea">{{$data['description'] or ''}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">企业简介</label>
            <div class="layui-input-block">
                <script id="jianjie" name="jianjie" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['qyjj']))echo htmlspecialchars_decode($data['qyjj']);
                    ?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">融资计划</label>
            <div class="layui-input-block">
                <script id="jihua" name="jihua" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['rzjh']))echo htmlspecialchars_decode($data['rzjh']);
                    ?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">企业亮点</label>
            <div class="layui-input-block">
                <script id="liangdian" name="liangdian" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['qyld']))echo htmlspecialchars_decode($data['qyld']);
                    ?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">市场价格</label>
            <div class="layui-input-block">
                <script id="price" name="price" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['scjz']))echo htmlspecialchars_decode($data['scjz']);
                    ?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">投资流程</label>
            <div class="layui-input-block">
                <script id="process" name="process" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['tzlc']))echo htmlspecialchars_decode($data['tzlc']);
                    ?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">上市回报分析</label>
            <div class="layui-input-block">
                <script id="callback" name="callback" type="text/plain" style="height:400px;width:800px;">
                    <?php
                    if(isset($data['shjh']))echo htmlspecialchars_decode($data['shjh']);
                    ?>
                </script>
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
            <label class="layui-form-label">项目状态</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="data[state]" lay-verify="required" class="layui-input search_input" style="width: 7em;">
                        <option value="进行中" <?php if($data['state']=='进行中')echo 'selected';?>>进行中</option>
                        <option value="已结束" <?php if($data['state']=='已结束')echo 'selected';?>>已结束</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">投资类型</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="data[leixing]" lay-verify="required" class="layui-input search_input" style="width: 7em;">
                        <option value="新股增发" <?php if($data['leixing']=='新股增发')echo 'selected';?>>新股增发</option>
                        <option value="老股转让" <?php if($data['leixing']=='老股转让')echo 'selected';?>>老股转让</option>
                        <option value="风投项目" <?php if($data['leixing']=='风投项目')echo 'selected';?>>风投项目</option>
                        <option value="天使投资" <?php if($data['leixing']=='天使投资')echo 'selected';?>>天使投资</option>
                        <option value="影视众筹" <?php if($data['leixing']=='影视众筹')echo 'selected';?>>影视众筹</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属地区</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="data[area]" lay-verify="required" class="layui-input search_input" style="width: 7em;">
                        <option value="北京" <?php if($data['area']=='北京')echo 'selected';?>>北京</option>
                        <option value="天津" <?php if($data['area']=='天津')echo 'selected';?>>天津</option>
                        <option value="上海" <?php if($data['area']=='上海')echo 'selected';?>>上海</option>
                        <option value="江苏" <?php if($data['area']=='江苏')echo 'selected';?>>江苏</option>
                        <option value="浙江" <?php if($data['area']=='浙江')echo 'selected';?>>浙江</option>
                        <option value="安徽" <?php if($data['area']=='安徽')echo 'selected';?>>安徽</option>
                        <option value="福建" <?php if($data['area']=='福建')echo 'selected';?>>福建</option>
                        <option value="山东" <?php if($data['area']=='山东')echo 'selected';?>>山东</option>
                        <option value="湖北" <?php if($data['area']=='湖北')echo 'selected';?>>湖北</option>
                        <option value="广东" <?php if($data['area']=='广东')echo 'selected';?>>广东</option>
                        <option value="云南" <?php if($data['area']=='云南')echo 'selected';?>>云南</option>
                        <option value="湖南" <?php if($data['area']=='湖南')echo 'selected';?>>湖南</option>
                        <option value="河北" <?php if($data['area']=='河北')echo 'selected';?>>河北</option>
                        <option value="河南" <?php if($data['area']=='河南')echo 'selected';?>>河南</option>
                        <option value="四川" <?php if($data['area']=='四川')echo 'selected';?>>四川</option>
                        <option value="辽宁" <?php if($data['area']=='辽宁')echo 'selected';?>>辽宁</option>
                        <option value="甘肃" <?php if($data['area']=='甘肃')echo 'selected';?>>甘肃</option>
                        <option value="其他" <?php if($data['area']=='其他')echo 'selected';?>>其他</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属行业</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="data[industry]" lay-verify="required" class="layui-input search_input" style="width: 7em;">
                        <option value="信息通讯">信息通讯</option>
                        <option value="移动互联">移动互联</option>
                        <option value="消费服务">消费服务</option>
                        <option value="节能环保">节能环保</option>
                        <option value="文化传媒">文化传媒</option>
                        <option value="生物制药">生物制药</option>
                        <option value="金融服务">金融服务</option>
                        <option value="工业制造">工业制造</option>
                        <option value="医疗器械">医疗器械</option>
                        <option value="能源材料">能源材料</option>
                        <option value="军工科技">军工科技</option>
                        <option value="农林牧渔">农林牧渔</option>
                        <option value="其他类别">其他类别</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">股权代码</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[guquandaima]" value="{{$data['guquandaima'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">公司名称</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[mc]" value="{{$data['mc'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">公司logo</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName imgs" name="data[gslogo]" value="{{$data['gslogo'] or ''}}">
                <span class="up">上传</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">优质项目</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[youzhixiangmu]" value="{{$data['youzhixiangmu'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">项目低价</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[djia]" value="{{$data['djia'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">锁定期限</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[rq]" value="{{$data['rq'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册资本</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[zczb]" value="{{$data['zczb'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">成立时间</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[cltime]" id="form_datetime_2" value="{{$data['cltime'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">首页缩略图</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName imgs" name="data[stu]" value="{{$data['stu'] or ''}}">
                <span class="up">上传</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">主办券商</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[zbqs]" value="{{$data['zbqs'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">本次发行</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[bcfx]" value="{{$data['bcfx'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">剩余股数</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[cygs]" value="{{$data['cygs'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">起头股数</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[qtgs]" value="{{$data['bcrz'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">本次融资</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[bcrz]" value="{{$data['bcrz'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">净资产</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[jingzichan]" value="{{$data['jingzichan'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">总股本</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[zgb]" value="{{$data['title'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">市盈率</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[shiyinglv]" value="{{$data['shiyinglv'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">每股收益</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[shouyi]" value="{{$data['shouyi'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">预计挂牌</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[yujiguapai]" value="{{$data['yujiguapai'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">上年净利润</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[sshouyi]" value="{{$data['sshouyi'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">项目进度</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[xiangmujindu]" value="{{$data['xiangmujindu'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">预估收益</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[yshouyi]" value="{{$data['yshouyi'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">预约数</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[yy]" value="{{$data['yy'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">企业新闻</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[xgwz]" value="{{$data['xgwz'] or ''}}">
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
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[time]" id="form_datetime_1" value="<?php echo date('Y-m-d H:i:s',$data['time']);?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">阅读数</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input newsName" name="data[hits]" value="{{$data['hits'] or ''}}">
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="addNews" id="sub">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
@endsection
@section('extendJs')
    <script type="text/javascript" src="/js/admin/newsAdd.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <script src="{{ URL::asset('/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('/js/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <script type="text/javascript">
    </script>
    <script>
        $(function(){
            $(".up").Upload({
                formData:{
                    type:'image',
                    _token:'{{ csrf_token() }}'
                },
                url:'{{url("/uploadImg")}}',
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
        $("#form_datetime_2").datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd hh:ii:ss',
            autoclose: true,
            todayBtn: true,
            startView: 'month',
            minView:'month',
            maxView:'decade'
        });;
    </script>
@endsection

