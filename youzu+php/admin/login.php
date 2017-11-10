<?php 
include_once 'functions.php';
$uid=checkLoginStatus();
if(!empty($uid)){
    header("location:main.php");
} 
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8" />
        <title>XXX-后台管理系统</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link href="public/ace/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="public/ace/css/font-awesome.min.css" />
       
        <link rel="stylesheet" href="public/ace/css/ace.min.css" />
        <link rel="stylesheet" href="public/ace/css/ace-rtl.min.css" />
        
    </head>
    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center" style="height:200px;">
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class=" icon-glass red"></i>
                                                XXX-后台管理系统--登录
                                            </h4>

                                            <div class="space-6"></div>

                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" />
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <label class="inline">
                                                            <input type="checkbox" class="ace" />
                                                            <span class="lbl"> Remember Me</span>
                                                        </label>

                                                        <button onclick="login()" type="button" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="icon-key"></i>登 录
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>

                                            <div class="social-or-login center">
                                                <span class="bigger-110">版权&copy;某某科技有限公司所有</span>
                                            </div>
                                        </div><!-- /widget-main -->
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->
                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->
        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='public/ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>
        <!-- <![endif]-->
        <!--[if IE]>
        <script type="text/javascript">
            window.jQuery || document.write("<script src='public/ace/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='public/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            function show_box(id) {
             jQuery('.widget-box.visible').removeClass('visible');
             jQuery('#'+id).addClass('visible');
            }
            function login(){
                var name = $.trim($("#username").val());
                var pwd = $.trim($("#pwd").val());
                $.post('loginAction.php',{name:name,pwd:pwd},function(e){
                    console.log(e);
                    if(e.status == 1){
                         window.location.href = "main.php";
                    }else{
                        alert(e.msg);
                    }
                },'json');
            }
        </script>
        <div style="display:none"></div>
    </body>
</html>
