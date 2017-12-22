<?php $__env->startSection('extendCss'); ?>
    <link rel="stylesheet" href="/css/news.css" media="all" />
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '股权项目'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn" style="background-color:#5FB878"><?php echo e($cate[$cid]); ?></a>
        </div>
        <div class="layui-inline">
            <form action="" id="searchForm">
                <div class="layui-input-inline">
                    <input type="hidden" name="cid" value="<?php echo e($cid); ?>"/>
                    <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" name="kw">
                </div>
                <a class="layui-btn search_btn">搜索标题</a>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal" href="<?php echo e(url('/Admin/content/add')); ?>?cid=<?php echo e($cid); ?>">添加项目</a>
            <?php /*<a class="layui-btn layui-btn-normal newsAdd_btn">添加项目</a>*/ ?>
        </div>
        <?php /*<script>*/ ?>
            <?php /*var cid = '<?php echo e($cid); ?>';*/ ?>
        <?php /*</script>*/ ?>
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
                <?php /*<th>审核</th>*/ ?>
                <th>状态</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody class="news_content">
            <?php if(isset($data)): ?>
                <?php $__empty_1 = true; foreach($data as $val): $__empty_1 = false; ?>
                    <tr>
                        <td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></td>
                        <td><?php echo e($val['id']); ?></td>
                        <td align="left"><a href="<?php echo e(url('/Admin/content/detail')); ?>/<?php echo e($val['id']); ?>"><?php echo e($val['title']); ?></a></td>
                        <td><?php echo e($cate[$cid]); ?></td>
                        <td><?php echo e($val['username']); ?></td>
                        <?php /*<td><input type="checkbox" name="show" lay-skin="switch" lay-text="是|否" lay-filter="isShow"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div></td>*/ ?>
                        <td><?php echo $val['status']==0?'<span style="color: red;" ">未审核</span>':'审核';?></td>
                        <td><?php echo e(date('Y-m-d H:i:s',$val['time'])); ?></td>
                        <td><a href="<?php echo e(url('/Admin/content/detail')); ?>/<?php echo e($val['id']); ?>" class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i> 编辑</a><a class="layui-btn layui-btn-danger layui-btn-mini news_del" data-id="undefined"><i class="layui-icon"></i> 删除</a></td>
                    </tr>
                <?php endforeach; if ($__empty_1): ?>
                <?php endif; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="page">
        <?php echo $data->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>
    <script type="text/javascript" src="/js/admin/newsList.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>