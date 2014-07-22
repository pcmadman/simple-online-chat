<?php
//一个较大的数组，用于存储聊天内容，通过ajax获取

//聊天内容		$strings['聊天室名','第N条内容'] 
$strings[][]=array();
//时间戳 		$timestamp['聊天室名']['时间戳'] 这个变量和$strings 成镜像
$timestamp[][]=array();
//发信人昵称	$postname['聊天室名']['昵称'] 这个变量和$strings 成镜像
$postname[][]=array();
//最新的时间戳
$newtimestamp;
//房间名
$room;
//昵称
$name;
//聊天内容
$texts;


//获取时间戳，如果没有时间戳，视作非法
if( $_POST['timestamp'] = '') {
	die('no time stamp');
}else{
	$newtimestamp = $_POST['timestamp'];
}

//获得昵称，如果为空，视作匿名
$name=$_POST['postname'] = '' ? 'Anonymous' : $_POST['postname'];

//如果房间名不为空，则设置房间名；如果为空使用default
$room = $_POST['room'] != '' ? $_POST['room'] : 'default';

//获得内容
$texts = $_POST['texts'];

//如果内容不为空，则添加最后一条内容
if ($_POST['texts']!= '' & )  {
	$strings[$room][]=$texts;
	$timestamp[$room][]=$newtimestamp;
	$postname[$room][]=$texts;
}

//如果某房间累计聊天数>=1000条则清空前500条
function array_remove(&$arr, $offset) 
{ 
	#删除数组 $arr 中索引为 $offset 的键值，且重建索引
	array_splice($arr, $offset, 1); 
}
if (count($strings[$room])>=1000) {
	for ($i=0; $i < 500 ; $i++) { 
		array_remove($strings[$room],0);#删除第N条内容
		array_remove($timestamp[$room],0);#删除第N条时间戳
	}
}


?>