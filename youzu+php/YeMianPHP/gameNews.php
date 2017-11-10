<?php
header("content-type:text/html;charset=utf-8");
include_once 'function.php';
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
//分页
$page = get('page');
$isAjax = get('isAjax');
$page = !empty($page) ? $page : 1;
$page_num = 10;
$count_sql = "SELECT COUNT(*) AS count_num from news where news_type='游戏新闻' AND status=1;";
$re_count= mysqli_query($mysql, $count_sql);
$count_data = mysqli_fetch_assoc($re_count);
$count_num = $count_data['count_num'];
$pageData=getAjaxPageParse($count_num,$page_num,2);
$start = ($pageData['pageIndex']-1)*$page_num;
$length = $page_num;
$sql6 = "SELECT * FROM news WHERE news_type='游戏新闻' AND STATUS=1 limit $start,$length ORDER BY create_time DESC;";
$re6= mysqli_query($mysql, $sql6);
$type = array();
while ($data6 = mysqli_fetch_assoc($re6)){
    $type[] = $data6;
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
    echo json_encode(array('value'=>$_SERVER,'status'=>1,'pageData'=>$pageData,'type'=>$type));
    exit();
}

$sql7="SELECT * FROM games ORDER BY RAND() LIMIT 0,5;";
$re7=mysqli_query($mysql, $sql7);
$temp=array();
while($data=mysqli_fetch_assoc($re7)){
    $temp[]=$data;
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
<title>全部新闻</title>
<link rel="stylesheet" href="../CSS/daohang.css"/>
<link rel="stylesheet" href="../CSS/News.css"/>
<link rel="stylesheet" href="../CSS/hai.css"/> 
<script src="../Common/jquery-1.10.2.min.js"></script>

<script src="../js/bg.js"></script>
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
    <div class="left">
        <p><a href="index1.html">首页</a>><a href="#">资讯</a>><a>游族新闻</a></p>
        <div class="left_title" id="left_title">
           <ul class="left_dao" id="left_dao">
                <li><span></span><a href="#">游戏新闻</a></li>
                <li><span></span><a href="actionNews.php">活动新闻</a></li>
                <li><span></span><a href="gameGonggao.php">游戏公告</a></li>
                <li><span></span><a href="gameGonglue.php">精华攻略</a></li>
            </ul>
        </div>
            <ul class="left_content" id="left_content">
            <?php foreach ($type as $v){?>
                <li>
                    <a href="#"><?php echo $v['news_title']?></a>
                    <span><?php echo date('Y-m-d H:i:s',$v['create_time'])?></span>
                    <a href="#">查看详情></a>
                </li>
            <?php }?>
            </ul>
            <?php echo $pageData['pageStr'];?>
    </div>
    <div class="right">
        <div class="right1">
            <p><b>推荐游戏</b><a>换一换></a></p>
            <ul>
                <?php foreach ($temp as $v){?>
                    <li><img src="<?php echo $v['img']?>"/>
                    <b><?php echo $v['game_name']?></b>
                    <a><?php echo $v['game_type']?></a>
                    <a href="#">官网</a>
                <?php }?>
            </ul>
        </div>
        <div class="right2">
            <div class="right2_1">
                <div class="right2_1_box" id="right2_1_box">
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
        <div class="right3">
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
<script src="../js/News.js"></script>
<script src="../js/bg.js"></script>
<script >
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
		    	$("#left_content").empty();
		    	$('.left div.pagenumQu').remove();
		    	var data = e.type;
		    	$.each(data,function(i){
		    	    var ob = data[i];
		    	    var date=new Date(ob.create_time*1000);
		    	    date1 = date.toLocaleString();
		    	    var str = '<li>';
		    	    str+='<a href="#">'+ob.news_title+'</a>';
		    	    str+='<span>'+date1+'</span>';
		    	    str+='<a href="#">查看详情></a>';
				    str +="</li>";
				    $("#left_content").append(str);
			    });
		    	$(".left").append(e.pageData.pageStr);
			}
		}
	});
}

</script>
</body>
</html>