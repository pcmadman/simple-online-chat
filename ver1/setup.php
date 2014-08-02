<?php

/* 简易安装程序 ver 0.2 */

//引用头文件
include_once 'php_header.php';

//创建表
$db->query("
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `strings` (
  `id` int(4) NOT NULL,
  `strings` varchar(4096) NOT NULL,
  `post_name` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `username` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `reg_time` timestamp NOT NULL,
  `last_login` timestamp NOT NULL,
  KEY `username` (`username`),
  FULLTEXT KEY `password` (`password`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
?>