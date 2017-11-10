<?php
header("content-type:text/html;charset=utf-8");
session_start();
include_once '../functions.php';
$uid = checkLoginStatus();
if(empty($uid)){
    header('location:../login.php');exit();
}
$c_role = checkRole();
if(!$c_role){
    header("location:../error.php");exit();
}
$all_type = $_SESSION['menu'];
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$sql = "SELECT * FROM menu WHERE status = 1 and pid=0";
$re = mysqli_query($mysql, $sql);
$type = array();
while ($data = mysqli_fetch_assoc($re)){
    $type[] = $data;
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>控制台 - 添加权限</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="../public/ace/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../public/ace/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../public/ace/css/ace.min.css" />
        <link rel="stylesheet" href="../public/ace/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../public/ace/css/ace-skins.min.css" />
        <script src="../public/ace/js/ace-extra.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>
            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <i class="icon-asterisk"></i>
                            XXX后台管理系统
                        </small>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->

                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="../public/ace/avatars/user.jpg" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>欢迎光临,</small>
                                    Jason
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i>个人资料
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-cog"></i>修改密码
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="#">
                                        <i class="icon-off"></i>
                                        退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.ace-nav -->
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>

                <div class="sidebar" id="sidebar">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>

                    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                            <button class="btn btn-success">
                                <i class="icon-signal"></i>
                            </button>

                            <button class="btn btn-info">
                                <i class="icon-pencil"></i>
                            </button>

                            <button class="btn btn-warning">
                                <i class="icon-group"></i>
                            </button>

                            <button class="btn btn-danger">
                                <i class="icon-cogs"></i>
                            </button>
                        </div>

                        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-success"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-warning"></span>

                            <span class="btn btn-danger"></span>
                        </div>
                    </div><!-- #sidebar-shortcuts -->

                    <ul class="nav nav-list">
                        <?php foreach ($all_type as $k=>$v){?>
                        <?php if(!isset($v['sub'])){?>
                            <li class="active">
                            <a href="<?php echo !empty($v['url']) ? $v['url'] : "javascript:;";?>">
                                <i class="<?php echo $v['icon'];?>"></i>
                                <span class="menu-text"><?php echo $v['title'];?> </span>
                            </a>
                            </li>
                        <?php }else{?>
                            <li class="active open">
                                <a href="#" class="dropdown-toggle">
                                    <i class="<?php echo $v['icon'];?>"></i>
                                    <span class="menu-text"><?php echo $v['title'];?></span>
    
                                    <b class="arrow icon-angle-down"></b>
                                </a>
    
                                <ul class="submenu">
                                    <?php foreach ($v['sub'] as $kk=>$vv){?>
                                    <li class="active">
                                        <a  href="<?php echo $vv['url'];?>">
                                            <i class="icon-double-angle-right"></i><?php echo $vv['title'];?>
                                        </a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php }}?>
                    </ul><!-- /.nav-list -->

                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>

                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>

                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home home-icon"></i>
                                <a href="#">首页</a>
                            </li>
                            <li>
                                <i class="icon-home home-icon"></i>
                                <a href="#">权限管理</a>
                            </li>
                            <li class="active">添加权限</li>
                        </ul><!-- .breadcrumb -->
                    </div>
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 widget-container-span">
                                <div class="widget-box">
                                            <div class="widget-header">
                                                <div class="widget-toolbar pull-left no-border">
                                                    <ul class="nav nav-tabs" id="myTab">
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#home">选项栏</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main padding-6">
                                                    <div class="tab-content">
                                                        <div id="home" class="tab-pane in active">
                                                            <form class="form-horizontal" action="addAction.php" method="post">
							                                    <div class="form-group">
							                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">权限描述</label>
							                                         <div class="col-sm-9">
							                                            <input type="text" name="remark" id="form-field-1" placeholder="remark" class="col-xs-10 col-sm-5" />
							                                        </div>
							                                    </div>
							                                    <div class="space-4"></div>
							                                     <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">权限路径</label>
                                                                     <div class="col-sm-9">
                                                                        <input type="text" name="url" id="form-field-2" placeholder="url" class="col-xs-10 col-sm-5" />
                                                                    </div>
                                                                </div>
                                                                <div class="space-4"></div>
                                                                <div class="clearfix ">
							                                        <div class="col-md-offset-3 col-md-9">
							                                            <button class="btn btn-info" type="submit">
							                                                <i class="icon-ok bigger-110"></i>添加
							                                            </button>&nbsp; &nbsp; &nbsp;
							                                            <button class="btn" type="reset">
							                                                <i class="icon-undo bigger-110"></i>重置
							                                            </button>
							                                        </div>
							                                    </div>
				                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->

                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="icon-cog bigger-150"></i>
                    </div>

                    <div class="ace-settings-box" id="ace-settings-box">
                        <div>
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="default" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; 选择皮肤</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                切换窄屏
                                <b></b>
                            </label>
                        </div>
                    </div>
                </div><!-- /#ace-settings-container -->
            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
        <!-- basic scripts -->
        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='../public/ace/js/jquery-2.0.3.min.js'>"+"<"+"script>");
        </script>
        <!-- <![endif]-->
        <!--[if IE]>
        <script type="text/javascript">
            window.jQuery || document.write("<script src='../public/ace/js/jquery-1.10.2.min.js'>"+"<"+"script>");
        </script>
        <![endif]-->
        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='../public/ace/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
        </script>
        <script src="../public/ace/js/bootstrap.min.js"></script>
        <script src="../public/ace/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="../public/ace/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="../public/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../public/ace/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../public/ace/js/jquery.slimscroll.min.js"></script>
        <script src="../public/ace/js/jquery.easy-pie-chart.min.js"></script>
        <script src="../public/ace/js/jquery.sparkline.min.js"></script>
        <script src="../public/ace/js/flot/jquery.flot.min.js"></script>
        <script src="../public/ace/js/flot/jquery.flot.pie.min.js"></script>
        <script src="../public/ace/js/flot/jquery.flot.resize.min.js"></script>
        <!-- ace scripts -->
        <script src="../public/ace/js/ace-elements.min.js"></script>
        <script src="../public/ace/js/ace.min.js"></script>
        <!-- inline scripts related to this page -->
    <div style="display:none"></div>
</body>
</html>

