<?php

/**
 * 检验私密页面的密码
 *
 * 使用方法,在有需要的加密的页面最开始补充下面这行代码
 *
 * <?php
 *  include('pass.php');
 * ?>
 *
 * 然后把本页代码命名为pass.php即可.
 *  
 *  PS:需要退出登录就直接在页面的后面加入请求password.php?action=logout
 */
$page_pwd = md5('617218'); //你要设置的密码
$page_cookname = 'my-page-password'; //你要设置的cookie名
$page_now = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
$action = @$_GET['action'];
$page_postpwd = @$_POST['page_pwd'];
$page_cookiepwd = @$_COOKIE["$page_cookname"];
$page_cookietime = time() + 60 * 60 * 24 * 7;
//输出网页的头部
$head =  '
    <head>
    <meta charset="utf-8">
    <title>密码访问 - 管理员操作页面</title>
    
    <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script>
$(function() {

    var myDate = new Date;
    var date = myDate.getDate();
    console.log(date);
    if(date==4){
        $("#xiaojiang").html("html{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%)}");
    }
   
})
</script>
<style id="xiaojiang"></style>
    <meta content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui" name="viewport" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta content="telephone=no" name="format-detection" />  
    <meta content="email=no" name="format-detection" />
    <meta name="apple-mobile-web-app-title" content="私人页面"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="telephone=no" name="format-detection"/>
    <style>
	  .vaptcha-init-main {
	    display: table;
	    width: 100%;
	    height: 100%;
	    background-color: #EEEEEE;
	  }
	
	  .vaptcha-init-loading {
	    display: table-cell;
	    vertical-align: middle;
	    text-align: center
	  }
	
	  .vaptcha-init-loading>a {
	    display: inline-block;
	    width: 18px;
	    height: 18px;
	    border: none;
	  }
	
	  .vaptcha-init-loading>a img {
	    vertical-align: middle
	  }
	
	  .vaptcha-init-loading .vaptcha-text {
	    font-family: sans-serif;
	    font-size: 12px;
	    color: #CCCCCC;
	    vertical-align: middle
	  }
	</style>
    <style>
    .botCenter{width:100%; height:38px; line-height:38px; background:#4ca6af00; position:fixed; bottom:0px; left:0px; font-size:12px; color:#000; text-align:center;}
    body{
    	background:url(admin/bg.png);
    }
    </style>
        <link rel="stylesheet" href="admin/pass.css">
        <script src="https://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
        <script src="https://lib.sinaapp.com/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">body,button,input,select,textarea,h1,h2,h3,h4,h5,h6 {
            font-family: Microsoft YaHei, "宋体", Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;
        }
    </style>
';

//退出登录
if ($action == "logout") {
    setcookie($page_cookname, "", time() - 1);
    echo '
    <meta http-equiv="refresh" content="2";URL='.$page_now.'>

    </head>
    <body>
    <div class="container-fluid">

    <p>退出成功,2秒后自动跳转</p>
    <a role="button" class="btn btn-success" href='.$page_now.'>点此马上跳转</a>

    </div>
    </body>
    </html>
    ';
    exit;
}

//有输入密码
if ($page_postpwd != "") {
    //密码错误
  if (md5("$page_postpwd") != $page_pwd) {
      echo $head;
      echo '

            <meta http-equiv="refresh" content="2";URL='.$page_now.'>
            </head>
            <body>
            <div class="container-fluid"><center><br><br>
             <a role="button" class="btn btn-danger" >密码错误,2秒后自动跳转</a>
                </center>
            </div>
            </body>
            </html>
            ';
        exit;
    }
    //密码正确
    else {
        //设置Cookies
        setcookie($page_cookname, md5("$page_postpwd"), $page_cookietime);
        echo $head;
        echo '
            <meta http-equiv="refresh" content="2";URL='.$page_now.'>
            </head>
            <body>
            <div class="container-fluid"><center><br><br>
             <a role="button" class="btn btn-success" >密码正确,2秒后自动跳转</a>
                </center>
            </div>
            </body>
            </html>
            ';
        exit;
    }
}
//没输入密码
if ($page_cookiepwd != $page_pwd) {
    echo $head;
    echo '
        </head>
        <body scroll="no" style="overflow-x:hidden;overflow-y:hidden;">
        <div class="row text-center vertical-middle-sm">
        <div class="col-sm-12">
        <div class="container-fluid">
        <br> <br> <br>
      
              <h5 id="mmts">管理员操作页面|游客禁止访问</h5>
        <br>
        <form method="POST">
            <div class="form-group">
        <input type="text" class="form-control" name="page_pwd" placeholder="请输入访问密码">
		<br/>
        <button type="submit" class="btn btn-success" >确认访问</button>
        </div>
        </div>
        </div>
        </form>
        </div>
        <div id="dibu" class="botCenter">
        <a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener">陇ICP备2021003459号</a>
		</div>
        </body>
        </html>
        ';
    exit;
}
?>