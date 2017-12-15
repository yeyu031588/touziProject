@extends('layout.admin')
@section('extendCss')
    <link rel="stylesheet" href="/css/news.css" media="all" />
@show
@section('title', '股权项目')
@section('content')
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn" style="background-color:#5FB878">{{$cate[$cid]}}</a>
        </div>
        <div class="layui-inline">
            <form action="" id="searchForm">
                <div class="layui-input-inline">
                    <input type="hidden" name="cid" value="{{$cid}}"/>
                    <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input"name="kw">
                </div>
                <a class="layui-btn search_btn">搜索标题</a>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" href="{{url('/Admin/content/add')}}?cid={{$cid}}">添加项目</a>
            {{--<a class="layui-btn layui-btn-normal newsAdd_btn">添加项目</a>--}}
        </div>
        {{--<script>--}}
            {{--var cid = '{{$cid}}';--}}
        {{--</script>--}}
        <div class="layui-inline">
            <a class="layui-btn audit_btn">审核项目</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
        </div>
        <div class="layui-inline">
            <div class="layui-input-inline">
                <select name="status" lay-verify="required" class="layui-input search_input" style="width: 7em;">
                    <option value="-1">全部</option>
                    <option value="1">正常</option>
                    <option value="2">推荐</option>
                    <option value="3">头条</option>
                    <option value="0">未审核</option>
                </select>
            </div>
        </div>
        <!--
        <div class="layui-inline">
            <div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
        </div>-->
    </blockquote>
    <div class="layui-form news_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
                <th>ID</th>
                <th style="text-align:left;">项目标题</th>
                <th>栏目</th>
                <th>发布人</th>
                {{--<th>审核</th>--}}
                <th>状态</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="news_content">
            @if(isset($data))
                @forelse($data as $val)
                    <tr>
                        <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                        <td>{{$val['id']}}</td>
                        <td align="left"><a href="{{url('/Admin/content/detail')}}/{{$val['id']}}">{{$val['title']}}</a></td>
                        <td>{{$cate[$cid]}}</td>
                        <td>{{$val['username']}}</td>
                        {{--<td><input type="checkbox" name="show" lay-skin="switch" lay-text="是|否" lay-filter="isShow"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div></td>--}}
                        <td><?php echo $val['status']==0?'<span style="color: red;" ">未审核</span>':'审核';?></td>
                        <td>{{date('Y-m-d H:i:s',$val['time'])}}</td>
                        <td><a href="{{url('/Admin/content/detail')}}/{{$val['id']}}" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini news_del" data-id="undefined"><i class="layui-icon"></i> 删除</a></td>
                    </tr>
                @empty
                @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $data->render(); ?>
    </div>
@endsection
@section('extendJs')
    <script type="text/javascript" src="/js/admin/newsList.js"></script>
@endsection
