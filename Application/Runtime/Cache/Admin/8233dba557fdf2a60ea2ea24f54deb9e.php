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
        <main class="col-md-10">
<div class="row">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo ($title); ?>节点</div>
        </div>
        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
            <form class="form-horizontal" method="post" action="<?php echo U('updateNode');?>">
                <fieldset>
                    <legend><?php echo ((isset($tip) && ($tip !== ""))?($tip):''); ?></legend>
                    <!--form id-->
                    <input  name="id" type="text"  value="<?php echo ($edit['id']); ?>" style="display: none;">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">字段:</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="name" name="name" type="text" placeholder="例:Auth/add" value="<?php echo ($edit['name']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">名称:</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="title" name="title" type="text" placeholder="例:添加节点" value="<?php echo ($edit['title']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="level">分类:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="level" name="level">
                                <option value="1">控制器</option>
                                <option value="2">方法</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="show_status">显示:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="show_status" name="show_status">
                                <option value="0">不显示</option>
                                <option value="1">显示</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="navGroup">
                        <label class="col-lg-2 control-label" for="nav">导航:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="nav" name="nav">
                                <?php if(is_array($parentNav)): $i = 0; $__LIST__ = $parentNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>"><?php echo ($data['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="controllerGroup">
                        <label class="col-lg-2 control-label" for="controller">控制器:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="controller" name="controller">
                                <?php if(is_array($parentController)): $i = 0; $__LIST__ = $parentController;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>"><?php echo ($data['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="sort">排序值:</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="sort" name="sort" type="text" placeholder="例:255" value="<?php echo ($edit['sort']); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">提交</button>
                    <button type="reset" class="btn btn-default" id="reset">还原</button>
                    <a class="btn btn-default" href="<?php echo U('index');?>">返回</a>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        reset();

        $('#reset').on('click',function () {
            setTimeout(reset,50);
        });

        $('#level').change(function () {
            levelChange()
        });

    });

    function levelChange() {
        var value = $('#level').val();
        if (value === "1"){
            $('#controllerGroup').hide();
            $('#navGroup').show();
        }else{
            $('#controllerGroup').show();
            $('#navGroup').hide();
        }
    }
    
    
    function reset() {
        var level = "<?php echo ($edit['level']); ?>";
        var show = "<?php echo ($edit['show_status']); ?>";
        var parent = "<?php echo ($edit['parent_id']); ?>";
        $('#level').val(level);
        $('#show_status').val(show);

        $('#nav').val(parent);
        $('#controller').val(parent);

        levelChange();
    }
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