<?php 
header("content-type:text/html;charset=utf-8");
include_once 'function.php';
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
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
<title>客服中心</title>
<link rel="stylesheet" href="../CSS/daohang.css"/>
<link rel="stylesheet" href="../CSS/keFu.css"/>
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
    <div class="div1">
        <p><a>自助服务</a><input type="text" placeholder="请输入您的问题"/><span></span></p>
        <hr/>
        <ul>
            <li><a><span></span>
                   <b>个人中心</b>
                </a>
                <i>您可以在这里........</i>
            </li>
            <li><a><span></span>
                   <b>个人中心</b>
                </a>
                <i>您可以在这里........</i>
            </li>
            <li><a><span></span>
                   <b>个人中心</b>
                </a>
                <i>您可以在这里........</i>
            </li>
            <li><a><span></span>
                   <b>个人中心</b>
                </a>
                <i>您可以在这里........</i>
            </li>
            <li><a><span></span>
                   <b>个人中心</b>
                </a>
                <i>您可以在这里........</i>
            </li>
        </ul>
    </div>
    <div class="div2">
        <p><a>自助服务</a><a>更多>></a></p>
        <hr/>
        <ul>
            <li>三十六计</li>
            <li>狂暴之翼</li>
            <li>盗墓笔记</li>
            <li>大皇帝</li>
            <li>少年三国志</li>
            <li>少年西游记</li>
            <li>刀剑乱舞</li>
            <li>女神联盟2</li>
        </ul>
    </div>
    <div class="div3">
        <p><a>自助服务</a><a>更多>></a></p>
        <hr/>
        <ul>
            <li><a>客服热线</a>
                <b>400 668 9919</b>
                <span></span>
                <p>7x24小时</p>
            </li>
            <li><a>在线客服</a>
                <b>400 668 9919</b>
                <span></span>
                <p>7x24小时</p>
            </li>
            <li><a>服务监督</a>
                <b>400 668 9919</b>
                <span></span>
                <p>7x24小时</p>
            </li>
        </ul>
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
<script src="../js/bg.js"></script>
</body>
</html>