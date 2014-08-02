/*
------------------------------------------
Name：对聊天页面的一系列控制
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
        查询消息列表中最后一条消息的ID
        ajax post 消息
        显示登陆对话框
        刷新消息列表
        显示隐藏侧边栏（在线人员列表）
        消息列表滚动到最低端
------------------------------------------
*/

$(document).ready(function() {
    $("#strings_post").click(function() {
        ScrollBottom();
        PostMessage();
    });
    $("#switch_user_list").click(function() {
        SwitchSidebar();
    });
    //    setInterval(function() { //700毫秒自动刷新
    //       RefreshPage();
    //    }, 700);
    $("#strings_strings").keydown( //回车键发送
        function(e) {
            if (e.which === 13) {
                PostMessage();
            }
        }
    );
    $("#login_show_dialog").click(function() { //显示登陆对话框
        $('#login_dialog').modal('show');
        $("#login_post").click(function() { //单击登陆按钮
            Login();
        });
    });
    $("#logout_show_dialog").click(function() { //退出
        Logout();
    });
});

function GetMaxId() { //查询消息列表中最后一条消息的ID
    var len = $("#strings_show blockquote").size(); //获取blockquote标签的个数
    var max = new Number; //最大值
    var idx = new Number; //当前id
    for (var idx = 1; idx < len; idx++) { //创建一个数字数组
        var idValue = parseInt($("#strings_show blockquote").eq(idx).attr("id"));
        if (idValue > max) {
            max = idValue; //对比最大值
        }
        idValue = 0;
    }
    return max;
};

function RefreshPage() { //刷新消息列表
    var last = new Number;
    last = GetMaxId();
    $.post("result_control_new.php", {
        refresh: "1",
        postname: $("#strings_postname").val(),
        strings: $("#strings_strings").val(),
        leastid: last
    }, function(data, status) {
        if (status !== "success") {
            //从服务器获取更新失败
            alert("从服务器获取消息列表失败!\n状态:" + status);
        } else {
            $(data).appendTo("#strings_show"); //插入聊天内容
            ScrollBottom();
        }
    });
};

function PostMessage() { //ajax post 消息
    if (strlen($("#strings_strings").val().length) > 0) {
        $.post("result_control_new.php", {
            refresh: "0",
            postname: $("#strings_postname").val(),
            strings: $("#strings_strings").val(),
            leastid: GetMaxId()
        }, function(data, status) {
            if (data === "0" || status !== "success") {
                //消息发送失败
                alert("数据：" + data + "\n状态：" + status);
            } else {
                //消息发送成功
                $(data).appendTo("#strings_show"); //插入聊天内容
                $("#strings_postname").attr("readonly", "readonly"); //锁定发送者名称
                ScrollBottom();
            }
        });
    };
};

function ScrollBottom() { //消息列表滚动到最低端
    $('#strings_show').scrollTop($('#strings_show')[0].scrollHeight); //让滚动条到底端
};

function SwitchSidebar() { //显示隐藏侧边栏（在线人员列表）
    $("#side_bar").fadeToggle(); //切换 人员列表 是否显示
    $("#content_left").removeClass(); //清楚内容的class

    if ($("#sidebar_checkbox").attr("checked") === "checked") { //是否选择了
        //重画
        $("#sidebar_checkbox").remove();
        $("#switch_user_list").prepend('<input id="sidebar_checkbox" type="checkbox"  />');
    } else {
        $("#content_left").addClass("col-md-9"); //设置占据9
        //重画
        $("#sidebar_checkbox").remove();
        $("#switch_user_list").prepend('<input id="sidebar_checkbox" type="checkbox" checked="checked" />');
    };
}

function Login() {
    var result;
    $.post("user_control.php", {
        login_username: $("#login_username").val(),
        login_password: $.md5($("#login_password").val()),
        action: "login"
    }, function(data) {
        if (data == "success") {
            $("#login_show_dialog").remove();
            $("#user_control_btn").prepend('<button style="width:100%" class="btn btn-warning" type="button" data-target="#logout" id="logout_show_dialog">退出<span class="glyphicon glyphicon-off"></span></button>');
        } else {
            alert("登陆失败");
        };
    });
}

function Logout() {
    $.post("user_control.php", {
        action: "logout"
    });
    $("#logout_show_dialog").remove();
    $("#user_control_btn").prepend('<button style="width:100%" class="btn btn-primary" type="button" data-target="#login" id="login_show_dialog">登陆<span class="glyphicon glyphicon-user"></span></button>')
}