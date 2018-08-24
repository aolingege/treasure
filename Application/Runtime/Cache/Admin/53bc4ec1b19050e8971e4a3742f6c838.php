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
<style type="text/css">
    .auth-row{
        display: flex;
        margin-right: -15px;
        margin-left: -15px;
        margin-bottom: 15px;
    }
    .auth-controller{
        text-align: right;
    }
    .auth-action{
        display: flex;
    }
    .auth-action-items{
        margin-right: 15px;
    }
    .auth-tip{
        font-size: 17px;
        color: #888;
    }
</style>
<div class="row">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo ($title); ?>权限组</div>
        </div>
        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
            <form class="form-horizontal" method="post" action="<?php echo U('update');?>">
                <fieldset>
                    <legend><?php echo ((isset($tip) && ($tip !== ""))?($tip):''); ?></legend>
                    <!--form id-->
                    <input  name="id" type="text"  value="<?php echo ($edit['id']); ?>" style="display: none;">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">权限组名称:</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="title" name="title" type="text" placeholder="请填写名称" value="<?php echo ($edit['title']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="status">组状态:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="status" name="status">
                                <option value="0">停止</option>
                                <option value="1">正常</option>
                            </select>
                        </div>
                    </div>
                    <!--row-->
                    <div class="form-group">
                        <span class="col-lg-2 control-label auth-tip">拥有权限:</span>
                        <div class="col-lg-10">
                        </div>
                    </div>
                    <?php if(is_array($authNode)): $i = 0; $__LIST__ = $authNode;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="auth-row">
                            <div class="auth-controller col-lg-2">
                                <label for="<?php echo ($item['name']); ?>"><?php echo ($item['title']); ?></label>
                                <input type="checkbox" id="<?php echo ($item['name']); ?>" value="<?php echo ($item['id']); ?>" name="auth_node[]">
                            </div>
                            <div class="auth-action col-lg-10">
                                <?php if(is_array($item['children'])): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><div class="auth-action-items">
                                        <label for="<?php echo ($action['name']); ?>"><?php echo ($action['title']); ?></label>
                                        <input type="checkbox" name="auth_node[]" id="<?php echo ($action['name']); ?>" value="<?php echo ($action['id']); ?>" class="auth-input">
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

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

        //controller all selected
        $('.auth-controller').on('click',function (e) {
            var controller = $(e.currentTarget);
            // main
            var checkbox = controller.children().eq(1);
            var actionCheckbox = controller.next().children();
            var is = checkbox.is(':checked');
            for (var i=0;i<actionCheckbox.length;i++){
                actionCheckbox.eq(i).children().eq(1).prop('checked',is);
            }
        });

        //action all selected
        $('.auth-action-items').on('click',function (e) {
            var action = $(e.currentTarget);
            var is = action.children().eq(1).is(':checked');
            var controller = action.parent().prev();
            if (is){
                controller.children().eq(1).prop('checked',is);
            }

            if(!is){
                var siblings = action.siblings();
                for (var i=0;i<siblings.length;i++){
                    var siblingsIs = siblings.eq(i).children().eq(1).is(':checked');
                    if(siblingsIs){
                        is = true;
                    }
                }
                if(!is){
                    controller.children().eq(1).prop('checked',is);
                }
            }
        });

    });


    //恢复默认值
    function reset() {
        var status = "<?php echo ($edit['status']); ?>";
        var checkbox = "<?php echo ($edit['rules']); ?>";
        var checkboxItem = checkbox.split(',');
        var checkboxs = $('input[type=checkbox]');
        for(var i=0;i<checkboxs.length;i++){
            for(var j=0;j<checkboxItem.length;j++){
                if (checkboxItem[j] === checkboxs.eq(i).val()){
                        checkboxs.eq(i).prop('checked',true);
                        break;
                }
            }
        }
        $('#status').val(status);
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