<?php $__env->startSection('extendCss'); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('title', '用户统计'); ?>
<?php $__env->startSection('content'); ?>
    <blockquote class="layui-elem-quote news_search">
        <form action="">
            <div class="layui-inline">
                <a class="layui-btn" style="background-color:#5FB878">选择月份</a>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" class="layui-input newsName" name="time" id="form_datetime_1">
                </div>
                <button class="layui-btn">查询</button>
            </div>
            <div class="layui-inline">
                <div class="layui-form-mid layui-word-aux"></div>
            </div>
        </form>
    </blockquote>
    <?php /*<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>*/ ?>
    <div id="container"></div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('extendJs'); ?>

    <script src="<?php echo e(URL::asset('/js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/bootstrap-datetimepicker.zh-CN.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/highcharts/highcharts.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/highcharts/series-label.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/highcharts/exporting.js')); ?>"></script>
    <script>
        $("#form_datetime_1").datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm',
            autoclose: true,
            todayBtn: true,
            startView: 'month',
            minView:'month',
            maxView:'decade'
        });;

        var chart;
        $(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    defaultSeriesType: 'line',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: "<?php echo $y.'-'.$m.'注册用户';?>",
                    x: -20 //center
                },
                subtitle: {
                    text: '日统计',
                    x: -20
                },
                xAxis: {
                    categories: [<?php foreach($md as $val)echo $val.',';?>]
                },
                yAxis: {
                    title: {
                        text: '位'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                                this.x +': '+ this.y +'位';
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: [{
                    name: 'num',
                    data: [<?php foreach($num as $val)echo $val.',';?>]
                }]
            });


        });

    </script>


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>