<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>对不起，你的页面未找到</title>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="10;URL=<?php echo U('index/index');?>">
    <!--bootstrap-->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type=text/css>
        .prompt-panel{
            width: 500px;
            margin: 150px auto;
        }
        .panel-body img{
            display: block;
            width: 400px;
            margin: 20px auto;
        }
        .panel-description{
            width: 435px;
            margin: 20px auto;
        }
        .panel-description strong{
            color: #ba1c1c;
        }
    </style>
</head>
<body>
    <!--Prompt panel-->
    <div class="panel panel-default prompt-panel">
        <div class="panel-body">
            <img src="/Public/images/404error.gif" alt="page not fond">
            <!--Description information-->
            <div class="panel-description">
                <p><strong>HTTP404错误</strong></p>
                <p>没有找到您要访问的页面，请检查您是否输入正确URL。</p>
                <p>请尝试以下操作：</p>
                <div>
                    <ul>
                        <li>如果您已经在地址栏中输入该网页的地址，请确认其拼写正确。</li>
                        <li>单击后退，尝试其他链接。</li>
                        <li>返回<a href="<?php echo U('index/index');?>">首页</a>。</li>
                        <li>联系管理员。</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>