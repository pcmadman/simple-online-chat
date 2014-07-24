<?php

/* 简易安装程序 ver 0.1 */

//引用头文件
include_once 'php_header.php';

//创建表
$db->query("CREATE TABLE IF NOT EXISTS `strings` (
  `id` int(4) NOT NULL,
  `strings` varchar(4096) NOT NULL,
  `post_name` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>