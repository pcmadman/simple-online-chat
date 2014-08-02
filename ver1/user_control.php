<?php 
/*
------------------------------------------
Name：用户控制
------------------------------------------
Version：0.2
------------------------------------------
Last modified time ：2014-07-31 16:53:11
------------------------------------------
Last modified by ：pcmadman
------------------------------------------
Email ：pcmadman@live.cn
------------------------------------------
行为：
	修改行为：
		添加用户
		添加管理员
		退出登录
		用户注销（从数据库中删除记录）
	查询行为：
		查询用户名密码是否匹配
		查询最后登陆时间
------------------------------------------
*/

//引用头文件
include_once 'php_header.php' ;

if ( empty ( $_POST ) ) {//如果post为空则停止执行
    die ( "Mail to :<a href='mailto:".WEB_MASTER."'>".WEB_MASTER."</a>" ) ;
}

//@$post_password=md5(addslashes ( ( string ) $_POST['login_password'] )) ; //过滤注入 + 读取post数据 + 直接转化成MD5
@$post_username=addslashes ( ( string ) $_POST['login_username'] ) ; //过滤注入
@$post_password=addslashes ( ( string ) $_POST['login_password'] ) ; //过滤注入 + 读取post数据
@$post_action=addslashes ( ( string ) $_POST['action'] ) ; //过滤注入

$session_isadmin=$_SESSION['isadmin'];
$session_username=$_SESSION['username'];


switch ($post_action) {
	case 'login'://登陆
		$sql="SELECT * FROM `users` WHERE `username` = '$post_username' and `password` = '$post_password';";//构造SQL语句
		$result= $db->get_row($sql);
		if (!empty($result)) {
			$db->query("UPDATE `users` SET `last_login`=NOW() WHERE `username` = '$post_username' and `password` = '$post_password';");//更改最后登陆时间
			/*存储登陆信息*/
			session_start();
			$_SESSION['username']=$post_username;
			$_SESSION['isadmin']=$result->isadmin;
			echo "success";
		}else{
			echo "faild";
		}

		break;
	case 'logout'://退出登录
		$_SESSION['username']="";
		$_SESSION['isadmin']="";
		echo "success";
		break;
	case 'user_delete'://注销（从数据库删除）用户
		/*如果用户名密码正确则会正确注销（从数据库删除）用户*/
		$sql="DELETE FROM `users` WHERE `username` = '$post_username' and `password` = '$post_password';";//构造SQL语句
		return $db->get_row($sql);

		break;
	case 'user_register'://注册
		$sql="
		INSERT INTO `users`(`username`,`password`,`reg_time`,`last_login`,`is_admin`)VALUES ('$post_username','$post_password', NOW(),NOW(),0);";//构造SQL语句
		return $db->get_row($sql);

		break;
	case 'add_admin'://添加管理员
		$sql = " SELECT * FROM `users` WHERE `username` = $session_username and `is_admin` = 1";
		$result=$db->get_row($sql);
		if (!empty($result)) {
			$sql="
			INSERT INTO `users`(`username`,`password`,`reg_time`,`last_login`,`is_admin`)VALUES ('$post_username','$post_password', NOW(),NOW(),1);";//构造SQL语句
			return $db->get_row($sql);
		}else{
			die ( "permission error" );
		}

		break;
	case 'query_last_login_time'://查询最后登陆时间
		$sql="SELECT `last_login` FROM `users` WHERE `username` = $post_username and `password`= $post_password";
		return $db->get_row($sql);

		break;
	default://$post_action 不符合则停止执行代码
		die ( "Mail to :<a href='mailto:".WEB_MASTER."'>".WEB_MASTER."</a>" );
		break;
}

?>