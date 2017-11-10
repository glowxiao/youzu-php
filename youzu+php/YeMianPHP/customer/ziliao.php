<?php
header("content-type:text/html;charset=utf-8");
include_once '../function.php';
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
<title>我的资料</title>
<link  rel="stylesheet" href="../../CSS/daohang.css"/>
<link  rel="stylesheet" href="../../CSS/customer.css"/>
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
    <div class="up">
        <div class="left">
            <span>&nbsp;</span>
            <p><span>&nbsp;</span>修改头像</p>
        </div>
        <div class="right">
            <div class="right1">
                <ul>
                <?php foreach ($temp5 as $v){?>
                    <li><b><?php echo $v['account_id']?></b><span>&nbsp;</span></li>
                    <li><a>账号：<?php echo $v['account_id']?></a>
                        <!-- <input type="button" value="修改密码"/> -->
                          <a href="./customer/pwd.php">修改密码</a> 
                    </li>
                    <li><a>等级：</a>
                        <div class="one"></div>
                        <div class="two"></div>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <hr/>
            <div class="right2">
                <ul>
                    <?php foreach ($temp5 as $v){?>
                    <li>
                        <span>&nbsp;</span>
                        <a>账户余额：</a>
                        <b><?php echo $v['Ubi']?></b>
                        <a>U币</a>
                        <input type="button" value="立即充值" onclick="location.href='../pay.php'"/>
                    </li>
                    <li>
                        <span>&nbsp;</span>
                        <a>积分：</a>
                        <b><?php echo $v['jifen']?></b>
                        <input type="button" value="赚取积分" onclick="location.href='../shop.php'"/>
                    </li>
                    <li>
                        <span>&nbsp;</span>
                        <a>信息完善：</a>
                        <b>50%</b>
                        <input type="button" value="完善资料"/>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <div class="down1">
        <div class="left">
            <div class="div1">
                <p>账号信息</p>
                <ul>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的资料</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的游戏</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的消息</a></li>
                </ul>
            </div>
            <div class="div2">
                <p>账号记录</p>
                <ul>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的充值</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的积分</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">游族花呗</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的礼包</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的商城</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">我的任务</a></li>
                </ul>
            </div>
            <div class="div3">
                <p>账号安全</p>
                <ul>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="pwd.php">修改密码</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">绑定账号</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="../customer.php">账号安全</a></li>
                    <li><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;<a href="#">实名认证</a></li>
                </ul>
            </div>
        </div>
         <div class="right " id="zhanghao">
            <div class="one"><b>我的资料</b></div>
            <div class="ziliao">
                <ul class='two_1'>
                    <?php foreach ($temp5 as $v){?>
                    <li><span>账号：</span><a><?php echo $v['account_id']?></a></li>
                    <li><span>昵称：</span><a><?php echo $v['nickname']?></a></li>
                    <li><span>性别：</span><a><?php echo $v['sex']?></a></li>
                    <li><span>QQ：</span><a><?php echo $v['QQ']?></a></li>
                    <li><span>学历：</span><a><?php echo $v['xueli']?></a></li>
                    <li><span>所在地：</span><a><?php echo $v['province']?><?php echo $v['city']?></a></li>
                    <?php }?>
                </ul>
                <input type="button" value='立即修改' onclick="location.href='ziliaoEdit.php'"/>
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
<script src="../../js/customer/customer.js"></script>
<script src="../../js/bg.js"></script>
</body>
</html>