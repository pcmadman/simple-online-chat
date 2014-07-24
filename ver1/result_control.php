<?php

/* 对ajax post 上来的数据进行操作 */
//引用头文件
include_once 'php_header.php';
echo $debug ? date('y-m-d H:i:s') . ":" . var_dump($_POST) : "";

//预置变量
$strings;       //发送上来的文本内容
$post_name; //发送人的昵称
$timestamp; //发送时间
$id;              //理应添加的ID
$least_id;     //客户端屏幕上显示的最后ID
//设置最后ID
$least_id = (integer) addslashes($_POST['leastid']); //过滤注入 - - 虽然不应该会在此有注入点
//设置文本
if (!empty($_POST['strings'])) {//如果发送内容不为空
    $strings = addslashes((string) $_POST['strings']); //过滤注入
} else { //发送内容为空
    echo "0";
}

//设置昵称
if (!empty($_POST['postname'])) {
    //如果发送人不为空
    $post_name = addslashes((string) $_POST['postname']); //过滤注入
} else {//如果人发送为空
    $post_name = '匿名者 ' . rand(1000, 9999);
}

//设置发送时间
$timestamp = date('y-m-d H:i:s');
//获取即将添加的ID
$id = (integer) $db->get_var("SELECT count(*) FROM strings") + 1;
//添加聊天内容
$sql = "INSERT INTO strings (`id`,`strings`,`post_name`,`timestamp`) VALUES ($id,'$strings', '$post_name', '$timestamp');";
echo $debug ? date('y-m-d H:i:s') . ":" . $sql : ""; //输出调试信息

if (!$db->query($sql)) {//SQL 执行失败或出错
    echo "0";
}

$sql_result = $db->get_results("SELECT * FROM strings");
$i = 0; //返回条数控制变量
$t_num = $id - 15 >= 0 ? $id - 15 : 0;
foreach ($sql_result as $result) {
    $t_id = $result->id;
    $t_strings = $result->strings;
    $t_post_name = $result->post_name;
    $t_timestamp = $result->timestamp;



    if ($i >= 15) {
        break; //超过15条停止读取
    }

    if ($t_id > $least_id and $t_id > $t_num) {//如果返回结果的 id 大于屏幕上最大ID 值
        $i++; //数量控制变量
        $html = "<blockquote id=\"$t_id\" "; //设置 id
        $html = ($post_name == $t_post_name) ? $html = $html . "class=\"blockquote-reverse\">" : $html = $html . ">"; // 检测是否为本人发出的消息,若果是,则放置右边
        $html = $html . "<p>" . $t_strings . "</p>"; //设置聊天内容
        $html = $html . "<footer><span class=\"text-primary\">" . $t_post_name . "</span> <span class=\"text-success\">"; //设置发送人昵称
        $html = $html . gmdate("H:i:s", strtotime($t_timestamp)) . "</span></footer>";
        $html = $html . "</blockquote>";
        echo $html;
    }
}
?>