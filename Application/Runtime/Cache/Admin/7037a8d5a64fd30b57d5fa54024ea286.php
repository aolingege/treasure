<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="/Public/vendors/jquery-1.9.1.js"></script>
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
                <?php if(is_array($config['navigation'])): $i = 0; $__LIST__ = $config['navigation'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="nav navbar-nav">
                        <li><a href="<?php echo U($vo['name'].'/index');?>"><?php echo ($vo['title']); ?></a></li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
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
                <?php if(is_array($config['current']['h3'])): $i = 0; $__LIST__ = $config['current']['h3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li class="parent-node <?php echo ((isset($data['active']) && ($data['active'] !== ""))?($data['active']):''); ?>">
                        <a href="javacript:void(0);"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo ($data['title']); ?></a>
                    </li>
                    <ul class="subset-node nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <?php if(is_array($data['children'])): $i = 0; $__LIST__ = $data['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h4): $mod = ($i % 2 );++$i;?><li class="subset" <?php echo ($h4['active']); ?> >
                                <a href="<?php echo U($h4['name']);?>"> <?php echo ($h4['title']); ?></a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
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

</div>
</div>


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
</script>

</body>
</html>