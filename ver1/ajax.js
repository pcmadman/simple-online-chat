$(document).ready(function(){
    $("button").click(function(){
        $.post("result_control.php",
        {
            refresh:false,
            postname:$("#postname").val(),
            strings:$("#strings").val(),
            leastid:GetMaxId()
        },
        function(data,status){
            if (data==="0" || status!=="success") {
                //消息发送失败
                alert("数据：" + data + "\n状态：" + status);
            }else{
                //消息发送成功
                $(data).appendTo("#show_strings");
            }
        });
    });
});

function GetMaxId(){
    var len = $("#show_strings blockquote").size();//获取blockquote标签的个数
    var max = new Number;//最大值
    for(var index = 0; index < len; index++){//创建一个数字数组
        var idValue = $("#show_strings blockquote").eq(index).attr("id");
        //alert("循环次数:"+index +"\nID 值:"+idValue);调试
        if (idValue>= max) {
            max=idValue;//对比最大值
        }
    }
    return max;
};

function RefreshPage(){
    $.post("result_control.php",
    {
        refresh:true,
        postname:$("#postname").val(),
        strings:$("#strings").val(),
        leastid:GetMaxId()
    }, 
    function(data,status){
        if (status!=="success") {
            //从服务器获取更新失败
            alert("从服务器获取消息列表失败!\n状态:" + status);
        }
    });
};