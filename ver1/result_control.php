<?php
//对ajax post 上来的数据进行操作

//引用头文件
include_once 'php_header.php';

//预置变量
$string;//发送上来的文本内容
$post_name;//发送人的昵称
$timestamp;//发送时间

//设置文本
if (!empty($_POST['string'])) {
	//如果发送内容不为空
	$string=$_POST['string'];
}else{
	//如果为空
}

//设置昵称
if (!empty($_POST['post_name'])) {
	//如果发送人不为空
	$post_name=$_POST['post_name'];
}else{
	//如果发送为空
	$post_name='匿名';
}

//设置发送时间
$timestamp=date('y-m-d H:i:s');
//添加聊天内容
$db->query("INSERT INTO strings (strings,post_name,timestamps,id) VALUES ('$strings', '$post_name', '$timestamp',NULL);");


?>
