<?php
/*
------------------------------------------
Name：返回信息控制
------------------------------------------
Version：0.1
------------------------------------------
Last modified time ：2014-07-30 21:53:39
------------------------------------------
Last modified by ：pcmadman
------------------------------------------
Email ：pcmadman@live.cn
------------------------------------------
行为：
    简单的注入防范
    返回最后N条消息
    插入一条消息到数据库
------------------------------------------
*/

/* 引用头文件 */
include_once 'php_header.php' ;

if ( empty ( $_POST ) ) {
    die ( "Mail to :<a href='mailto:".WEB_MASTER."'>PCmadman</a>" ) ;
}


/* 声明变量 */
$least_id ; //客户端屏幕上显示的最后ID
$strings ; //发送上来的文本内容
$post_name ; //发送人的昵称
$timestamp ; //发送时间
$id ; //理应添加的ID

/* 设置文本 */
if ( ! empty ( $_POST['strings'] ) ) {//如果发送内容不为空
    $strings = addslashes ( ( string ) $_POST['strings'] ) ; //过滤注入
} else {
    $strings = " " ;
}

/* 设置昵称 */
if ( ! empty ( $_POST['postname'] ) ) {//如果发送人不为空
    $post_name = addslashes ( ( string ) $_POST['postname'] ) ; //过滤注入
} else {//如果人发送为空
    $post_name = '匿名者' ;
}

/* 设置发送时间 */
$timestamp = strftime ( "%Y-%m-%d %X" , time () ) ;

/* 获取即将添加的ID */
$id = ( integer ) $db -> get_var ( "SELECT count(id) FROM strings" ) + 1 ;

/* 设置最后ID */
$least_id = $_POST['leastid'] ; //过滤注入--虽然不应该会在此有注入点

if ( $_POST['refresh'] == 1 ) {
    /* ---------------*
     * 要求刷新内容 *
     * -------------- */
    $sql_result = $db -> get_results ( "SELECT * FROM strings" ) ;
    if ( ! empty ( $sql_result ) ) {//如果返回信息不是0条
        $sql_result = array_chunk ( $db -> get_results ( "SELECT * FROM strings" ) , 1 ) ; //从服务器获取聊天内容
    } else {//
        die () ;
    }
    $i = (count ( $sql_result ) - 30 >= 0) ? count ( $sql_result ) - 30 : 0 ; //最多一次性给予30条内容控制
    for ( $i ; $i <= count ( $sql_result ) ; $i ++ ) {
        /* 变量初始化 */
        if ( $least_id < $i ) {
            $t_id = $sql_result[$i - 1][0] -> id ;
            $t_strings = $sql_result[$i - 1][0] -> strings ;
            $t_post_name = $sql_result[$i - 1][0] -> post_name ;
            $t_timestamp = $sql_result[$i - 1][0] -> timestamp ;


            $html = "<blockquote id=\"$t_id\"" . ">" ; //设置id
            $html = $html . "<p>" . $t_strings . "</p>" ; //设置聊天内容
            $html = $html . "<footer><span class=\"text-primary\">" . $t_post_name . "</span> <span class=\"text-success\">" ; //设置发送人昵称
            $html = $html . gmdate ( "H:i:s" , strtotime ( $t_timestamp ) ) . "</span></footer>" ;
            $html = $html . "</blockquote>" ;
            echo $html ;
            $html = "" ;
            //$least_id ++ ;
        }
    }
} else {
    /* ---------------*
     * 添加聊天内容 *
     * -------------- */

    $sql = "INSERT INTO strings(`id`,`strings`,`post_name`,`timestamp`)VALUES($id,'$strings','$post_name','$timestamp');" ;
    echo $debug ? date ( 'y-m-d H:i:s' ) . ":" . $sql : "" ; //输出SQL调试信息
    if ( ! $db -> query ( $sql ) ) {//SQL执行失败或出错
        die ( "sql error" ) ;
    }

    $sql_result = $db -> get_results ( "SELECT * FROM strings" ) ; //从服务器获取聊天内容
    $i = 0 ; //返回条数控制变量
    $t_num = $id - 15 >= 0 ? $id - 15 : 0 ;

    foreach ( $sql_result as $result ) {
        /* 变量初始化 */
        $t_id = $result -> id ;
        $t_strings = $result -> strings ;
        $t_post_name = $result -> post_name ;
        $t_timestamp = $result -> timestamp ;

        if ( $i >= 15 ) {
            break ; //超过15条停止读取
        }

        if ( $t_id > $least_id and $t_id > $t_num ) {//如果返回结果的id大于屏幕上最大ID值
            $i ++ ; //数量控制变量
            $html = "<blockquote id=\"$t_id\"" ; //设置id
            $html = ($post_name == $t_post_name) ? $html = $html . "class=\"blockquote-reverse\">" : $html = $html . ">" ; //检测是否为本人发出的消息,若果是,则放置右边
            $html = $html . "<p>" . $t_strings . "</p>" ; //设置聊天内容
            $html = $html . "<footer><span class=\"text-primary\">" . $t_post_name . "</span> <span class=\"text-success\">" ; //设置发送人昵称
            $html = $html . gmdate ( "H:i:s" , strtotime ( $t_timestamp ) ) . "</span></footer>" ;
            $html = $html . "</blockquote>" ;
            echo $html ;
            $html = "" ;
        }
    }
}
?>