<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($config['current']['h2']['title']); ?></title>
    <!-- Bootstrap -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/Public/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <!-- Bootstrap Admin Theme -->
    <link href="/Public/css/bootstrap-admin-theme.css" rel="stylesheet" media="screen">

    <!--dialog-->
    <link href="/Public/css/ui-dialog.css" rel="stylesheet" media="screen">
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
        .dataTables_filter label{
            float: right;
        }
        #tableList_paginate{
            float: right;
        }
    </style>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="/Public/vendors/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        // datatables language
        var lang = {
            lengthMenu: '<select class="dataTables_length form-control" >' +
            '<option value="10">10</option>' +
            '<option value="25">25</option>' +
            '<option value="50">50</option>' +
            '<option value="75">75</option>' +
            '<option value="100">100</option>' +
            '<option value="500">500</option>' +
            '</select>',
            search: '',
            oPaginate: {
                "sFirst": "首页",
                "sPrevious": "上页",
                "sNext": "下页",
                "sLast": "末页"
            },
            zeroRecords: "<div>没有内容</div>",
            info: "<div>共_PAGES_ 页，当前_START_ - _END_ ，筛选后 _TOTAL_ 条，初始_MAX_ 条 </div>",
            infoEmpty: "<div>0条记录</div>",//筛选为空时左下角的显示。
            infoFiltered: "",
            sLoadingRecords: "载入中...",
            sProcessing: "处理中...",
            oAria: {
                "sSortAscending": ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            }
        };
    </script>
</head>
<body class="bootstrap-admin-with-small-navbar">
<!--Top navigation bar-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top " role="navigation">
    <div class="container">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">admin</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if(is_array($config['navigation'])): $i = 0; $__LIST__ = $config['navigation'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="nav navbar-nav">
                        <li><a href="<?php echo U($vo['name'].'/index');?>"><?php echo ($vo['title']); ?></a></li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">管理员<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick="resetPsw()">重置密码</a></li>
                            <li><a href="<?php echo U('login/viewPermissions');?>">查看权限</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('login/loginOut');?>">退出登录</a></li>
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
                <?php if(is_array($config['current']['h3'])): $i = 0; $__LIST__ = $config['current']['h3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li class="parent-node <?php echo ((isset($data['active']) && ($data['active'] !== ""))?($data['active']):''); ?>">
                        <a href="javacript:void(0);"><i class="glyphicon <?php echo ((isset($data['icon']) && ($data['icon'] !== ""))?($data['icon']):'glyphicon-chevron-right'); ?>"></i> <?php echo ($data['title']); ?></a>
                    </li>
                    <ul class="subset-node nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <?php if(is_array($data['children'])): $i = 0; $__LIST__ = $data['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h4): $mod = ($i % 2 );++$i;?><li class="subset" <?php echo ($h4['active']); ?> >
                                <a href="<?php echo U($h4['name']);?>"> <?php echo ($h4['title']); ?></a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <main class="col-md-10">
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
                            <div class="text-muted bootstrap-admin-box-title">采集信息</div>
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
                        <div class="text-muted bootstrap-admin-box-title">后台登录统计</div>
                        <div class="pull-right"><span class="badge">今日登录总数:<?php echo ($log['all']); ?>次</span></div>
                    </div>
                    <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                        <div class="charts" id="charts-error"></div>
                        <div class="chart-bottom-heading">
                            <span class="label label-info">登录成功率：<?php echo ($log['normal']); ?>/<?php echo ($log['all']); ?>次</span>
                        </div>
                    </div>
                </div>
            </div>

</div>
<script>
    $(function () {
        var login = '<?php echo ($login); ?>';
        var loginObj = JSON.parse(login);
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
                    ['验证码错误',   loginObj.code],
                    ['正常登录',     loginObj.normal],
                    ['密码错误',    loginObj.psw],
                    ['其他',   loginObj.other]
                ]
            }]
        });
    });
</script>
</div>
</div>
</main>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/twitter-bootstrap-hover-dropdown.min.js"></script>

<!--highcharts-->
<script type="text/javascript" src="/Public/vendors/highcharts/highcharts.js"></script>
<!--<script src="/Public/vendors/highcharts/modules/series-label.js"></script>-->
<!--<script src="/Public/vendors/highcharts/modules/exporting.js"></script>-->
<!--<script src="/Public/vendors/highcharts/modules/export-data.js"></script>-->

<!--dataTables js-->
<script type="text/javascript" src="/Public/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/js/dataTables.bootstrap.min.js"></script>

<!--dialog-->
<script type="text/javascript" src="/Public/js/dialog-plus-min.js"></script>
<script type="text/javascript" src="/Public/js/common.js"></script>


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
    
    
    function resetPsw() {
        confirm('确认重置密码?','提示',function () {
            $.ajax({
               type:"POST",
               url:"<?php echo U('login/resetPsw');?>",
               data:{is:true},
               success:function (res) {
                    if(res.status === 1){
                        tips('重置为123456',4);
                    }
               },
               error:function () {
                   tips('重置失败');
               }
            });
        });
    }


    
</script>

</body>
</html>