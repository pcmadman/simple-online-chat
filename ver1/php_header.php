<?php

//引用ezsql
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";
//引用配置文件
include_once "configuration.php";
//创建数据库操作变量
$db = new ezSQL_mysql(DB_USER, DB_PAWD, DB_NAME, DB_HOST);
//定义编码
header('Content-Type:text/html;charset=utf-8 ');
?>