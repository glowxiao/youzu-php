<?php
header("content-type:text/html;charset=utf-8");
session_start();
include_once '../functions.php';
include_once '../fpage.php';
$uid = checkLoginStatus();
if(empty($uid)){
    header('location:../login.php');
}
$c_role = checkRole();
if(!$c_role){
    header("location:../error.php");
}
$all_type = $_SESSION['menu'];
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
 $sql = "SELECT * FROM games ";
$re = mysqli_query($mysql, $sql);
$temp = array();
while ($data = mysqli_fetch_assoc($re)){
    $temp[] = $data;
} 


//分页
$page = get('page');
$isAjax = get('isAjax');
$page = !empty($page) ? $page : 1;
$page_num = 10;
$count_sql = "SELECT COUNT(*) AS count_num from games where status=1;";
$re_count= mysqli_query($mysql, $count_sql);
$count_data = mysqli_fetch_assoc($re_count);
$count_num = $count_data['count_num'];
$pageData=getAjaxPageParse($count_num,$page_num,2);
$start = ($pageData['pageIndex']-1)*$page_num;
$length = $page_num;
$sql6 = "SELECT * FROM games limit $start,$length;";
$re6= mysqli_query($mysql, $sql6);
$type = array();
while ($data6 = mysqli_fetch_assoc($re6)){
    $type[] = $data6;
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
    echo json_encode(array('value'=>$_SERVER,'status'=>1,'pageData'=>$pageData,'type'=>$type));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>控制台 - 首页</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
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
							<li class="active">控制台</li>
						</ul><!-- .breadcrumb -->
					</div>
                    <div class="page-content">
						<div class="page-header">
							<h1>
								控制台
								<small>
									<i class="icon-double-angle-right"></i>
									 查看
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="center">
                                                            <label>
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>游戏名称</th>
                                                        <th>创建时间</th>
                                                        <th>修改时间</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tbody">
                                                    <?php foreach ($type as $v){?>
                                                    <tr>
                                                        <td class="center">
                                                            <label>
                                                                <input type="checkbox" name="game_id[]" value="<?php echo $v['game_id'];?>" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>
                                                        <td><?php echo $v['game_id'];?></td>
                                                        <td><?php echo $v['game_name'];?></td>
                                                        <td><?php echo date("Y-m-d H:i:s",$v['create_time']);?></td>
                                                        <td><?php echo date("Y-m-d H:i:s",$v['update_time']);?></td>
                                                        <td>
                                                            <?php if($v['status']==1){?>
                                                            <a class="btn btn-info btn-xs" href="edit.php?id=<?php echo $v['game_id'];?>">编辑</a>
                                                            <a class="btn btn-danger btn-xs" href="del.php?action=del&id=<?php echo $v['game_id'];?>">删除</a>
                                                            <?php }else {?> 
                                                            <a class="btn btn-danger btn-xs" href="del.php?action=rel&id=<?php echo $v['game_id'];?>">恢复</a>
                                                            <?php }?>                                                            
                                                        </td>
                                                    </tr>
                                                    <?php }?>                                           
                                                </tbody>
                                            </table>
                                            <div id="aaa"><?php echo $pageData['pageStr'];?></div>
                                           <!--  <ul class="pagination pull-right no-margin">
                                                    <li class="prev disabled">
                                                        <a href="#">
                                                            <i class="icon-double-angle-left"></i>
                                                        </a>
                                                    </li>

                                                    <li class="active">
                                                        <a href="#">1</a>
                                                    </li>

                                                    <li>
                                                        <a href="#">2</a>
                                                    </li>

                                                    <li>
                                                        <a href="#">3</a>
                                                    </li>

                                                    <li class="next">
                                                        <a href="#">
                                                            <i class="icon-double-angle-right"></i>
                                                        </a>
                                                    </li>
                                                </ul> -->
                                        </div><!-- /.table-responsive -->
                                    </div><!-- /span -->
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
        <script type="text/javascript">
			window.jQuery || document.write("<script src='../public/ace/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>
        <script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../public/ace/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script src="../public/ace/js/bootstrap.min.js"></script>
		<script src="../public/ace/js/typeahead-bs2.min.js"></script>

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
    <script>
    function getPage(i){
    	Date.prototype.toLocaleString = function() {
            return this.getFullYear() + "-" + (this.getMonth() + 1) + "-" + this.getDate() + " " + this.getHours() + ":" + this.getMinutes() + ":" + this.getSeconds() + "";
      };
    	var url = $(i).attr("data-href");
    	$.ajax({
    		url:url,
    		type:'get',
    		data:'isAjax=1',
    		dataType:'json',
    		success:function(e){
    		    console.log(e);
    		    if(e.status == 1){
    		    	$("#tbody").empty();
    		    	$('.pagenumQu').remove();
    		    	var data = e.type;
    		    	$.each(data,function(i){
    		    	    var ob = data[i];
    		    	    var date=new Date(ob.create_time*1000);
    		    	    var date2=new Date(ob.update_time*1000);
    		    	    date1 = date.toLocaleString();
    		    	    date3=date2.toLocaleString();
    		    	    var str = '<tr>';
    		    	    str+=' <td class="center">';
    		    	    str+='<label>';
    		    	    str+='<input type="checkbox" name="game_id[]" value='+ob.game_id+' class="ace" />';
    				    str +="<span class='lbl'></span>";
    				    str+="</label>";
    				    str+="</td>";
    				    str+="<td>"+ob.game_id+"</td>";
    				    str+="<td>"+ob.game_name+"</td>";
    				    str+="<td>"+date1+"</td>";
    				    str+="<td>"+date2+"</td>";
    				    str+="<td>";
    				    if(ob.status==1){
        				    str+=" <a class='btn btn-info btn-xs' href='edit.php?id="+ob.game_id+"'>编辑</a>";
        				    str+=" <a class='btn btn-danger btn-xs' href='del.php?action=del&id="+ob.game_id+"'>删除</a>";
    				    }else{
        				    str+="<a class='btn btn-danger btn-xs' href='del.php?action=rel&id="+ob.game_id+"'>恢复</a>";
    				    }
    				    str+="</td>";
    				    str+="</tr>";
    				    $("#tbody").append(str);
    			    });
    		    	$(".pagenumQu").append(e.pageData.pageStr);
    			}
    		}
    	});
    }
    </script>
</body>
</html>

