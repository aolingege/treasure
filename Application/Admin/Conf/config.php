<?php
return array(
	//'配置项'=>'配置值'

    //无需进行登录验证的控制器 格式为 控制器=>方法1,方法2...
    'UNLIMITED_CONTROLLER' => array('Login','Empty', 'Client', 'Api'),

    //无须权限验证的控制器 格式为：控制器=>方法1,方法2...
    'UNAUTHED_CONTROLLER' => array(
        'Login',
        'Empty',
        'Client',
        'Api',
    ),

    'TMPL_PARSE_STRING' => array(                //模版中使用的常量
        '__UPLODO__' => '/Public/Admin',
    ),

    'LAYOUT_ON' => true,                //启动全局布局配置
    'LAYOUT_NAME' => 'Layout/layout',    //布局文件名称
    'TMPL_LAYOUT_ITEM' => '{__CONTENT__}',    //模版内容替换变量

    'LOAD_EXT_CONFIG' => 'code',

);