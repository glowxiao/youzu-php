<?php

header("content-type:text/html;charset=utf-8");
include_once 'function.php';
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$sql="select * from games where game_id<4;";
$re=mysqli_query($mysql, $sql);
$temp=array();
while($data=mysqli_fetch_assoc($re)){
    $temp[]=$data;
}
//精品页游
$sql1="select * from games where game_id<10 && game_id>6;";
$re1=mysqli_query($mysql, $sql1);
$temp1=array();
while($data1=mysqli_fetch_assoc($re1)){
    $temp1[]=$data1;
}
//热门手游
$sql2="select * from games where game_id<13 && game_id>9;";
$re2=mysqli_query($mysql, $sql2);
$temp2=array();
while($data2=mysqli_fetch_assoc($re2)){
    $temp2[]=$data2;
}
//休闲游戏
$sql2="select * from games where game_id<13 && game_id>9;";
$re2=mysqli_query($mysql, $sql2);
$temp2=array();
while($data2=mysqli_fetch_assoc($re2)){
    $temp2[]=$data2;
}

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
<title>首页</title>
<link  rel="stylesheet"href="../CSS/daohang.css"/>
<link rel="stylesheet" href="../CSS/index.css"/>
<link rel="stylesheet" href="../CSS/Right.css"/>
 <link rel="stylesheet" href="../CSS/hai.css"/> 
 <link rel="stylesheet" href="../CSS/index2.css"/> 
<script src="../Common/jquery-1.10.2.min.js"></script>
</head>
<body>
<div class="top">
    <a class="logo" href="#"></a>
    <ul class="ul1">
        <li><span></span><a href="index1.php"class="active">首页</a></li>
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
    <div class="bg" id="bg">
        <div class="box" id="box">
            <img src="../img/index/1.jpg" />
	        <img src="../img/index/2.jpg"/>
	        <img src="../img/index/3.jpg"/>
	        <img src="../img/index/4.jpg"/>
        </div>
        <ul class="point" id="point">
            <li class="active3"></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="left">
        <div class="first" id="first">
            <span>精品页游</span>
            <span>+更多></span>
           <ul class="first_ul">
                    <?php foreach ($temp as $v){?>
                    <li>
                         <div class="jin"><img src="<?php echo $v['img']?>"/><div class="zhe" ></div><div class="tan" ><img src="<?php echo $v['tan_img']?>"/></div></div>
                    	 <b><?php echo $v['game_name']?></b><span>&nbsp;</span>
    	                 <a>官网</a>
    	                 <a>|</a>
    	                 <a>礼包</a>
    	                 <a>类型：<?php echo $v['game_class']?></a>
    	                 <a href='#'>开始游戏</a>
                   </li>
                     <?php }?>
            </ul>
        </div>

        <div class="two" id="two">
            <span>热门手游</span>
            <span>+更多></span>
            <ul>
                <?php foreach ($temp1 as $v1){?>
                    <li>
                        <img src="<?php  echo $v1['img']?>"/>
                        <div class="two1 " id="two1">
                            <b><?php echo $v1['game_name']?></b>
                            <p>类型：<?php echo $v1['game_class']?></p>
                            <p>官网</p>
                            <input type="button"class="btn" value="应用下载"/>
                            <i>
                                <span ></span>
                                <span></span>
                            </i>                     
                        </div>
                    </li>
                <?php }?>
            </ul>
        </div>
        <hr/>
        <div class="three" id="three">
            <span>休闲游戏</span>
            <span>+更多></span>
            <ul>
                <?php foreach ($temp2 as $v){?>
                <li>
                    <img src="<?php echo $v['img'] ?>"/>
                    <div class="three1" id="three1">
                        <b><?php echo $v['game_name']?></b>
                        <p>类型：<?php echo $v['game_type']?></p>
                        <input type="button"class="btn"value="应用下载"/>
                        <i><span>&nbsp;</span>
                        <span>&nbsp;</span></i>
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
        <hr/>
        <div class="four">
            <span>活动中心</span>
            <span>+更多></span>
            <ul>
                <li><a href="#"><img src="../img/index/17.jpg"/></a></li>
                <li><a href="#"><img src="../img/index/18.jpg"/></a></li>
                <li><a href="#"><img src="../img/index/19.jpg"/></a></li>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class='div1'>
            <p><a href="#">注销</a></p>
            <div class='div1_1'>
                <div class="div1_1_left">
                    <b><img src="../img/customer/portrait.png"/></b>
                    <b>为你推荐游戏</b>
                </div>
                <div class="div1_1_right">
                <?php foreach ($temp5 as $v){?>
                    <ul>
                        <li><a href="#"><?php echo $v['account_id']?></a></li>
                        <li><a>LV0</a><span></span><span></span></li>
                        <li>U币<a href="#"><?php echo $v['Ubi']?></a></li>
                        <li>积分<a href="#"><?php echo $v['jifen']?></a></li>
                        <li>消息<a href="#"><span></span></a></li>
                    </ul>
                <?php }?>
                </div>
            </div>
            
            
            
            <div class='div1_2'>
                <ul>
                    <li><a href="#">盗墓笔记</a><span></span><a href="#">进入新服</a></li>
                    <li><a href="#">三十六计</a><span></span><a href="#">进入新服</a></li>
                    <li><a href="#">刀剑乱舞</a><span></span><a href="#">进入新服</a></li>
                </ul>
            </div>
        </div>
        <div class="div2">
            <div class="div2_1">
                <ul>
                    <li id="lie" class="fu">开服列表</li>
                    <li id="yu">新服预告</li>
                </ul>
            </div>
             <div class="div2_2 xin" id="kai">
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
            <div class="div2_2"  id="xin">
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
        <div class="div3">
            <ul class="hai">
                <li><span>&nbsp;</span><a>海外平台</a></li>
                <li><span>&nbsp;</span><a>400-668-9919</a></li>
                <li><span>&nbsp;</span><a>游戏美女</a></li>
                <li><span>&nbsp;</span><a>新浪微博</a></li>
                <li><span>&nbsp;</span><a>腾讯微博</a></li>
                <li><span>&nbsp;</span><a>关注微信</a></li>
                <li><span>&nbsp;</span><a>未成年人家长监护工程</a></li>
            </ul>
        </div>
    </div>
</div>
<hr/>
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


<div class="zhebg" id="zhebg"></div>
<div class="zhuce" id="zhuce">
      <form action='zhuce.php' method='get'>
            <ul class='zhuce_input'>
                <li>快速注册<span id="span">X</span></li>
                <li><input type='text' name='zhanghao' id='zhanghao' placeholder='账号' onBlur='Move()'/></li>
                <li><input type='password' name='pwd' id='pwd' placeholder='密码'/></li>
                <li><input type='password' name='queren' id='queren'placeholder='确认密码' onBlur='Move1()'/></li>
                <li><input type='text' name='nickname' placeholder='昵称'/></li>
                <li><input type='text' placeholder='验证码'/></li>
                <li><input type='checkbox'/>阅读并同意该协议</li>
                <li><input type='submit' value='提交'/></li>
            </ul>
        </form>
</div>
<script src="../js/bg.js"></script>
<script src="../js/zhe.js"></script>
<script src="../js/zhuce.js"></script>
<script>
var a=new zhe();
a.Zhe("first");
var b=new An();
b.an("two1");  
b.an("three1");  




</script>
</body>
</html>