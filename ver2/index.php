<?php
//引用配置文件
include_once "config.php";

//设置超时时间
set_time_limit(0);

// 创建一个Socket
$socket=socket_create(AF_INET,//AF_INET	IPv4 网络协议。TCP 和 UDP 都可使用此协议。
SOCK_STREAM,//SOCK_STREAM	提供一个顺序化的、可靠的、全双工的、基于连接的字节流。支持数据传送流量控制机制。TCP 协议即基于这种流式套接字。
SOL_TCP) or die("Could not create socket\n");

//绑定到指定的地址和端口
$result=socket_bind($socket,HOST_NAME,PORT_NUM) or die("Could not bind to socket\n");


?>