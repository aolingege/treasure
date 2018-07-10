<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
    <!-- Bootstrap -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/Public/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <!-- Bootstrap Admin Theme -->
    <link href="/Public/css/bootstrap-admin-theme.css" rel="stylesheet" media="screen">
    <style>
        .subset a:hover{
            background-color: #21a9ec !important;
            color: #fff;
        }
        .nav>li>a:hover, .nav>li>a:focus {
            text-decoration: none;
            background-color: #08C;
            color: #fff;
        }
        .subset-node > li:first-child > a {
             -webkit-border-radius:  0;
            -moz-border-radius: 0;
            border-radius:  0;
        }
        /*.style="width: 110px; height: 110px; line-height: 110px;"*/
        .charts{
            min-width: 400px;
            height: 400px;
            /*line-height: 110px;*/
            /*style="min-width:400px;height:400px"*/
        }
    </style>
</head>
<body class="bootstrap-admin-with-small-navbar">
<!--Top navigation bar-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top " role="navigation">
    <div class="container">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">admin</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo U('index/index');?>">首页</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo U('index/index');?>">权限</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">重置密码</a></li>
                            <li><a href="#">查看权限</a></li>
                            <li class="divider"></li>
                            <li><a href="#">退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
</nav>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <div class="col-md-2 bootstrap-admin-col-left">
            <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                <li class="parent-node active">
                    <a href="javacript:void(0);"><i class="glyphicon glyphicon-chevron-right"></i> 首页</a>
                </li>
                <ul class="subset-node nav navbar-collapse collapse bootstrap-admin-navbar-side">
                    <li class="subset">
                        <a href="#"> 首页信息</a>
                    </li>
                    <li class="subset">
                        <a href="#"> 关于我们</a>
                    </li>
                </ul>

                <!--<li class="parent-node">-->
                    <!--<a href="javacript:void(0);"><i class="glyphicon glyphicon-chevron-right"></i> 首页2</a>-->
                <!--</li>-->
                <!--<ul class="subset-node nav navbar-collapse collapse bootstrap-admin-navbar-side">-->
                    <!--<li class="subset" style="display: none">-->
                        <!--<a href="#"> 首页信息2</a>-->
                    <!--</li>-->
                    <!--<li class="subset" style="display: none">-->
                        <!--<a href="#"> 关于我们2</a>-->
                    <!--</li>-->
                <!--</ul>-->


            </ul>
        </div>

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                    <ol class="breadcrumb bootstrap-admin-breadcrumb">
                        <li>
                            <a href="<?php echo U('index/index');?>">首页</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row bootstrap-admin-no-edges-padding">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">采集详情</div>
                            <div class="pull-right"><span class="badge">今日累计采集数 14564</span></div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>采集类型</th>
                                    <th>采集数</th>
                                    <th>任务开始时间</th>
                                    <th>任务结束时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>美食</td>
                                    <td>1221</td>
                                    <td>2018-07-10 07:06:01</td>
                                    <td>2018-07-10 07:15:01</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="panel panel-default bootstrap-admin-no-table-panel">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">后台负载</div>
                    </div>
                    <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                        <div class="charts" id="charts-load"></div>
                        <div class="chart-bottom-heading">
                            <span class="label label-info">服务器时区：东八区</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="panel panel-default bootstrap-admin-no-table-panel">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">后台登录统计</div>
                        <div class="pull-right"><span class="badge">今日登录总数:100次</span></div>
                    </div>
                    <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                        <div class="charts" id="charts-error"></div>
                        <div class="chart-bottom-heading">
                            <span class="label label-info">登录成功率：3/100次</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="/Public/vendors/jquery-1.9.1.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/twitter-bootstrap-hover-dropdown.min.js"></script>

<!--highcharts-->
<script src="/Public/vendors/highcharts/highcharts.js"></script>
<!--<script src="/Public/vendors/highcharts/modules/series-label.js"></script>-->
<!--<script src="/Public/vendors/highcharts/modules/exporting.js"></script>-->
<!--<script src="/Public/vendors/highcharts/modules/export-data.js"></script>-->

<script type="text/javascript">
    $('.parent-node').on('click',function(e){
        // Trigger element
        var $triggerElement = $(e.target);
        if ($triggerElement.hasClass('glyphicon')){
            // parent-node
            $triggerElement = $triggerElement.parent();
        }
        //排他
        $('.parent-node').removeClass('active');
        $('.glyphicon-chevron-down').removeClass('glyphicon-chevron-down pull-right').addClass('glyphicon-chevron-right');
        var $subsetNode = $triggerElement.parent('.parent-node').addClass('active').children();
        //font-icon
        $subsetNode.children().removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down pull-right');
        // Display list
        var $displayList = $subsetNode.parent().next().children().slideDown(300);
        $('.subset').each(function (index,element) {
            if(!$(element).is($displayList))
                $(element).slideUp(300);
        });
    });


    var chart = Highcharts.chart('charts-error', {
        title: {
            text: '登录错误率'
        },
        tooltip: {
            headerFormat: '{series.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,  // 可以被选择
                cursor: 'pointer',       // 鼠标样式
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: '错误类型',
            data: [
                ['验证码错误',   45.0],
                ['正常登录',       26.8],
                ['密码错误',    8.5],
                ['其他',   0.7]
            ]
        }]
    });

</script>

</body>
</html>