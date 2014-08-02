<?php include_once 'php_header.php' ; ?>
<html>
  <head>
    <title>simple online chat</title>
    <script src="bootstrap/js/jquery.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="jquery.md5.js" type="text/javascript"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="ajax.js" type="text/javascript"></script>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="container">
      <div class="page-header" id="top">
        <div class="row" >
          <div class="col-md-10">
            <h1 style="display:inline">Simple online chat <small>thank for vist.</small></h1>
          </div>
          <div class="col-md-1" id="user_control_btn">
            <?php 
            if (empty($_SESSION['username']) or $_SESSION['username'] == "" or $_SESSION['username'] == null) {
              //输出登陆按钮
              echo '<button style="width:100%" class="btn btn-primary" type="button" data-target="#login" id="login_show_dialog">
            登陆<span class="glyphicon glyphicon-user"></span>
            </button>';
            } else{
              //输出退出登录按钮
              echo '<button style="width:100%" class="btn btn-warning" type="button" data-target="#logout" id="logout_show_dialog">
            退出<span class="glyphicon glyphicon-off"></span>
            </button>';
            }?>
            <div class="modal" id="login_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">用户登录</h4>
                  </div>
                  <div class="modal-body">
                    <label for="login_username">用户名</label>
                    <input id="login_username" class="form-control" type="text">
                    <label for="login_password">密码</label>
                    <input id="login_password" class="form-control" type="password">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消<span class="glyphicon glyphicon-remove"></span></button>
                    <button type="button" class="btn btn-success" id="login_post" data-dismiss="modal">登录<span class="glyphicon glyphicon-ok"></span></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="dropdown">
              <button style="width:100%" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="show_set_menu">
              设置<span class="glyphicon glyphicon-cog"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a id="switch_user_list" role="menuitem" tabindex="-1" href="#">
                  <input id="sidebar_checkbox" type="checkbox" checked="checked" /> 显示在线人员</a>
                </li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="content" style="height:700px">
        <div id="content_left" class="col-md-9">
          <div class="panel panel-primary" style="width:100%; height:100%;">
            <div class="panel-heading">
              <h3 class="panel-title">聊天内容</h3>
            </div>
            <div class="panel-body" id="strings_show" style=" width: 100%; overflow: auto;height:605px"></div>
            <div class="panel-footer">
              <div class="row">
                <div class="col-lg-2">
                  <input type="text" id="strings_postname" class="form-control" placeholder="匿名" style="text-align: center;">
                </div>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="strings_strings">
                </div>
                <div class="col-lg-2">
                  <button id="strings_post" class="btn btn-primary col-lg-12" type="button">发送(Enter)</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3" id="side_bar">
          <div class="panel panel-primary" style="width:100%; height:100%;">
            <div class="panel-heading">在线人员</div>
            <ul class="list-group" style="height:617px;overflow:auto;margin-right:1px;">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
            <div class="panel-footer" id="side_bar_num">当前在线：0人</div>
          </div>
        </div>
      </div>
      <hr>
      <footer id="bottom"><small>2014 ,Code by <a href="mailto:pcmadman@live.cn">PCmadman</a>,<a href="https://github.com/pcmadman/simple-online-chat/"> on Github </a> , css template by <a href="http://v3.bootcss.com/">Bootstrap</a></small>.</footer>
    </div>
  </body>
</html>