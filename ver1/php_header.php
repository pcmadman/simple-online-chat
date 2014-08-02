<?php
/*
------------------------------------------
Name：加载项和编码控制
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
	引用ezsql
	引用配置文件
	创建数据库操作变量
	定义编码
------------------------------------------
*/
//引用ezsql
include_once "ez_sql_core.php" ;
include_once "ez_sql_mysql.php" ;
//引用配置文件
include_once "configuration.php" ;
//创建数据库操作变量
$db = new ezSQL_mysql ( DB_USER , DB_PAWD , DB_NAME , DB_HOST ) ;
//定义编码
header ( 'Content-Type:text/html;charset=utf-8 ' ) ;
//启动session
session_start();
?>