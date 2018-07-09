<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>后台登录</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/Public/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <!-- Bootstrap Admin Theme Custom Css -->
        <link href="/Public/css/bootstrap-admin-theme.css" rel="stylesheet" media="screen">
        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>
    </head>
    <body class="bootstrap-admin-without-padding">
        <div class="container">
            <div class="row">
                <div class="alert alert-info">
                    <a class="close" href="javascript:void(0)" onclick="$('.alert').hide(100);">&times;</a>
                    <div id="prompt-message">
                        <?php
 if(isset($message)) echo $message; else echo '欢迎您，请填写信息进行登录。'; ?>
                    </div>
                </div>
                <form method="post" action="<?php echo U('login');?>" class="bootstrap-admin-login-form">
                    <h1>登录</h1>
                    <div class="form-group">
                        <input class="form-control" type="text" name="account" placeholder="账号" value="<?php echo I('post.account','');?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="密码">
                    </div>
                    <div class="form-group verification-box">
                        <input class="form-control" type="text" name="code" placeholder="验证码">
                        <img src="<?php echo U('code');?>" alt="Verification Code" class="verification-code" onClick="this.src=this.src+'?'+Math.random();" title="看不清？点击换一张">
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit">提交</button>
                </form>
            </div>
        </div>
        <!--jquery-->
        <script type="text/javascript" src="/Public/vendors/jquery-3.3.1.min.js"></script>
        <!--bootstrap-->
        <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
        <!--jquery-validation-->
        <script type="text/javascript" src="/Public/vendors/jquery-validation/jquery.validate.js"></script>
        <!--jquery-validation-language-->
        <script type="text/javascript" src="/Public/vendors/jquery-validation/localization/messages_zh.js"></script>
        <!--page-auto-->
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="account"]').focus();
                // Setting width of the alert box
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));
                $('.alert').width(formWidth - 2 * alertPadding);
                //validation
                $(".bootstrap-admin-login-form").validate({
                    errorPlacement: function(error, element) {
                        // Append error within linked label
                        $('.alert').show(100);
                        $('#prompt-message').html(error);
                    },
                    rules: {
                        account: {
                            required: true,
                            rangelength:[4,15]
                        },
                        password: {
                            required: true,
                            rangelength:[6,18]
                        },
                        code: {
                            required: true
                        }
                    },
                    messages: {
                        account: {
                            required: "账号输入账号",
                            rangelength: "用户名长度为 4至15 位"
                        },
                        password: {
                            required: "请输入密码",
                            rangelength: "密码长度为 6至18 位"
                        },
                        code:{
                            required: "请输入验证码"
                        }
                    }
                })
            });
        </script>
    </body>
</html>