<?php
header("content-type:text/html;charset=utf-8");
include_once 'function.php';
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
/* $sql="SELECT *FROM games WHERE game_type='页游' AND STATUS=1;";
$re=mysqli_query($mysql, $sql);
$temp=array();
while($data=mysqli_fetch_assoc($re)){
    $temp[]=$data;
} */
//开服
$sql3="SELECT game_name,service_name,open_time FROM qufu,games WHERE qufu.`game_id`=games.`game_id` ORDER BY RAND() LIMIT 5;";
$re3=mysqli_query($mysql, $sql3);
$temp3=array();
while($data3=mysqli_fetch_assoc($re3)){
    $temp3[]=$data3;
}
//新服
$sql4="SELECT game_name,service_name,open_time FROM qufu,games WHERE qufu.`game_id`=games.`game_id` ORDER BY open_time DESC LIMIT 5;";
$re4=mysqli_query($mysql, $sql4);
$temp4=array();
while($data4=mysqli_fetch_assoc($re4)){
    $temp4[]=$data4;
}

//分页
$page = get('page');
$isAjax = get('isAjax');
$page = !empty($page) ? $page : 1;
$page_num = 4;
$count_sql = "SELECT COUNT(*) AS count_num from games where game_type='页游' AND status=1;";
$re_count= mysqli_query($mysql, $count_sql);
$count_data = mysqli_fetch_assoc($re_count);
$count_num = $count_data['count_num'];
$pageData=getAjaxPageParse($count_num,$page_num,2);
$start = ($pageData['pageIndex']-1)*$page_num;
$length = $page_num;
$sql6 = "SELECT * from games where game_type='页游' AND status=1 limit $start,$length";
$re6= mysqli_query($mysql, $sql6);
$type = array();
while ($data6 = mysqli_fetch_assoc($re6)){
    $type[] = $data6;
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
    echo json_encode(array('value'=>$_SERVER,'status'=>1,'pageData'=>$pageData,'type'=>$type));
    exit();
}
//登录
session_start();
if(isset($_SESSION["code"])){
    $zhanghao=$_SESSION['account_id'];
}
$sql5="SELECT * FROM message WHERE account_id='{$zhanghao}' AND STATUS=1;";
$re5=mysqli_query($mysql, $sql5);
$temp5=array();
while ($data5=mysqli_fetch_assoc($re5)){
    $temp5[]=$data5;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>游戏中心</title>
<link rel="stylesheet" href="../CSS/daohang.css"/>
<link rel="stylesheet" href="../CSS/game.css"/>
<link rel="stylesheet" href="../CSS/hai.css"/>
<script src="../Common/jquery-1.10.2.min.js"></script>
<style>

</style>
</head>
<body>
<div class="top">
    <a class="logo" href="#"></a>
    <ul class="ul1">
        <li><span></span><a href="index2.php"class="active">首页</a></li>
        <li><span></span><a href="customer.php">用户中心</a></li>
        <li><span></span><a href="YeYou.php">游戏中心</a></li>
        <li><span></span><a href="pay.php">充值中心</a></li>
        <li><span></span><a href="keFu.php">客服中心</a></li>
        <li><span></span><a href="shop.php">积分商城</a></li>
        <li><span></span><a href="gameNews.php">新闻中心</a></li>
    </ul>
    <ul class="ul2">
       <?php foreach ($temp5 as $v){?>
       <li><a href="#"><?php echo $v['account_id']?></a></li>
       <li>|</li>
       <li><a href="login.php?action=logout">注销</a></li>
       <?php }?>
    </ul>
    <div class="select1"><span class="you">&nbsp;</span>游族游戏</div>
</div>
<div class="main">
    <div class="top1" id="top1">
        <div >
            <ul class="box" style="left:0px;position:absolute;" id="box">
            <li><img src="../img/game/lun1.jpg"/></li>
            <li><img src="../img/game/lun2.jpg"/></li>
            <li><img src="../img/game/lun3.jpg"/></li>
            <li><img src="../img/game/lun4.jpg"/></li>
            <li><img src="../img/game/lun1.jpg"/></li>
            </ul>
        </div>
        
	         <ul  id="point" class="point" >
	            <li class='bian'id='l-1'></li>
	            <li id='l-2'></li>
	            <li id='l-3'></li>
	            <li id='l-4'></li>
	        </ul>
    </div>
    <div class="main2">
        <div class="left" >
            <div class="left1" id="left1">
                <ul>
                    <li><a href="#">页游</a></li>
                    <li><a href="ShouYou.php">手游</a></li>
                    <li><a href="XiuXianYouXi.php">休闲游戏</a></li>
                </ul>
            </div>
            <div class="left_box" id="left_box">
            <!-- 页游 -->
                 <div class="left2 xian" id="left2_1">
                    <?php foreach ($type as $v){?>
                        <div class='first' id='first'>
                          <div class="jin"><div class="zhe" ></div><div class="tan" ><img src="<?php echo $v['tan_img']?>"/></div></div>
                          <ul>
                            <li><img src="<?php echo $v['img']?>"/></li>
                            <li>
                                <b><?php echo $v['game_name']?></b>
                                <a>类型：<?php echo $v['game_class']?></a>
                                <p><?php echo $v['game_content']?></p>
    
                                <a href="#">进入官网</a>
                                <a href="#">开始游戏</a>
                            </li>
                            <li>
                                <img src="<?php echo $v['icon_img']?>"/>
                                <p>领取新手礼包</p>
                                <a href="#">领取礼包</a>
                            </li>
                         </ul>
                        </div>
                    <?php }?>
                            <p><?php echo $pageData['pageStr'];?></p>
            </div>
           </div>

           
        </div>
        <div class="right">
	        <div class="div1">
	            <div class="div1_1">
	                <ul>
	                    <li id="lie" class="fu">开服列表</li>
	                    <li id="yu">新服预告</li>
	                </ul>
	            </div>
	             <div class="div1_2 xin" id="kai">
	               <ul>
	                   <?php foreach ($temp3 as $v){?>
                    <li>
                        <b><?php echo $v['game_name']?></b>
                        <a href="#"><?php echo $v['service_name']?></a>
                        <p><?php echo $v['open_time']?></p>
                        <a href='#'>进入></a>
                    </li>
                    <hr/>
               <?php }?> 
	               </ul>
	       
	            </div> 
	            <div class="div1_2"  id="xin">
	               <ul>
	                    <?php foreach ($temp4 as $v){?>
                             <li>
                                <b><?php echo $v['game_name']?></b>
                                <a href="#"><?php echo $v['service_name']?></a>
                                <p><?php echo $v['open_time']?></p>
                                <a href='#'>进入></a>
                            </li>
                            <hr/>
                        <?php }?>
	               </ul>
	            </div> 
	          </div>
	        <div class="div2">
	           <p>
	               <span>热门活动</span>
                   <span>+更多></span>
	           </p>
	           <div class="div2_1">
	               <div class="div2_1_box" id="div2_1_box">
	                   <img src="../img/game/r1.jpg"/>
	                   <img src="../img/game/r2.jpg"/>
	                   <img src="../img/game/r3.jpg"/>
	                   <img src="../img/game/r4.jpg"/>
	                    <img src="../img/game/r1.jpg"/>
	               </div>
	             <ul  id="point" class="point" >
	                <li class='bian'id='r-1'></li>
	                <li id='r-2'></li>
	                <li id='r-3'></li>
	                <li id='r-4'></li>
                </ul>
	           </div>
	        </div>
	        <div class="div3">
	            <ul class="hai">
	                <li><span>&nbsp;</span><a>海外平台</a></li>
	                <li><span>&nbsp;</span><a>客服服务</a></li>
	                <li><span>&nbsp;</span><a>游戏美女</a></li>
	                <li><span>&nbsp;</span><a>新浪微博</a></li>
	                <li><span>&nbsp;</span><a>腾讯微博</a></li>
	                <li><span>&nbsp;</span><a>关注微信</a></li>
	                <li><span>&nbsp;</span><a>未成年人家长监护工程</a></li>
	            </ul>
        </div>
        </div>
    </div>
</div>
<div class="down">
    <span>&nbsp;</span>
    <ul>
        <li>关于游族</li>
        <li>游族无线</li>
        <li>联系我们</li>
        <li>加入我们</li>
        <li>客服中心</li>
        <li>商务合作</li>
        <li>用户许可协议</li>
    </ul>
     <ul>
        <li>推荐游戏：</li>
        <li><a>少年三国志</a></li>
        <li><a>射雕英雄传</a></li>
        <li><a>军师联盟</a></li>
        <li><a>三十六计</a></li>
        <li><a>刀剑乱舞</a></li>
        <li><a>盗墓笔记</a></li>
        <li><a>狂暴之翼</a></li>
    </ul> 
    <ul>
        <li><a>备案号：310104100043687</a></li>
        <li><a>沪B2-20090105号</a></li>
        <li><a>沪ICP备09058784号</a></li>
        <li><a>沪网文[2015]0819-219</a></li>
        <li><a>新出网证（沪）字33号</a></li>
    </ul>
</div>
<script src="../js/game.js"></script>
<script src="../js/lun.js"></script>
<script src="../js/zhe.js"></script>
<script src="../js/bg.js"></script>
<script>
function getPage(i){
	var url = $(i).attr("data-href");
	$.ajax({
		url:url,
		type:'get',
		data:'isAjax=1',
		dataType:'json',
		success:function(e){
		    console.log(e);
		    if(e.status == 1){
		    	$("#left2_1").empty();
		    	var data = e.type;
		    	$.each(data,function(i){
		    	    var ob = data[i];
		    	    console.log(ob.tan_img);
		    	    var str = '<div class="first" id="first">';
		    	    str += '<div class="jin"><div class="zhe" ></div><div class="tan" ><img src="'+ob.tan_img+'"/></div></div>';
		    	    str +='<ul>';
		    	    str+='<li><img src="'+ob.img+'"/></li>';
		    	    str+='<li>';
		    	    str+='<b>'+ob.game_name+'</b>';
		    	    str+='<a>类型：'+ob.game_class+'</a>';
		    	    str+=' <p>'+ob.game_content+'</p>';
		    	    str+='<a href="#">进入官网</a>';
		    	    str+='<a href="#">开始游戏</a>';
		    	    str+='</li>';
		    	    str+='<li>';
		    	    str+='<img src="'+ob.icon_img+'"/>';
		    	    str+='<p>领取新手礼包</p>';
		    	    str+='<a href="#">领取礼包</a>';
		    	    str+='</li>';
		    	    str+='</ul>';
				    str +="</div>";
				    $("#left2_1").append(str);
			    });
		    	$("#left2_1").append('<p>'+e.pageData.pageStr+'</p>');
			}
		}
	});
}


</script>
</body>
</html>