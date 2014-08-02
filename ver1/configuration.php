<?php

/*
------------------------------------------
Name：基础配置文件
------------------------------------------
Version：0.2
------------------------------------------
Last modified time ：2014-07-30 21:53:39
------------------------------------------
Last modified by ：pcmadman
------------------------------------------
Email ：pcmadman@live.cn
------------------------------------------
行为：
	定义一些列变量
	调试模式控制
	时区设置
------------------------------------------
*/

define ( 'DB_USER' , 'root' ) ; //用户名
define ( 'DB_PAWD' , 'root' ) ; //密码
define ( 'DB_NAME' , 'chat' ) ; //数据库名
define ( 'DB_HOST' , 'localhost' ) ; //数据库地址

define ( 'WEB_MASTER' , 'pcmadman@live.cn' ) ; //网站管理员email

$debug = FALSE ; //是否为调试模式

date_default_timezone_set ( "Asia/Chongqing" ) ; //默认时区设置

?>
