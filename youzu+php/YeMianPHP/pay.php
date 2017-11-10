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
<title>Insert title here</title>
<link rel="stylesheet" href="../CSS/daohang.css"/>
<link rel="stylesheet" href="../CSS/pay.css"/>
<script src="../Common/jquery-1.10.2.min.js"></script>
</head>
<body>
<div class="top">
    <a class="logo" href="#"></a>
    <ul class="ul1">
        <li><span></span><a href="index2.php"class="active">首页</a></li>
        <li><span></span><a href="customer.php">用户中心</a></li>
        <li><span></span><a href="game.php">游戏中心</a></li>
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
<div class="main" id="main">
<div class="right">
        <div class="right1" id="right1">
            <p>选择充值方式</p>
            <ul>
                <li><span></span>U币兑换游戏币</li>
                <li><span></span>网上银行</li>
                <li><span></span>支付宝</li>
                <li><span></span>微信支付</li>
                <li><span></span>手机固话充值</li>
                <li><span></span>游戏点卡充值</li>
                <li><span></span>国际信用卡</li>
                <li><span></span>短信充值</li>
                <li><span></span>转账汇款</li>
            </ul>
        </div>
        <div class="right2">
            <ul>
                <li>客服电话</li>
                <li>400 668 9919</li>
                <li>
                    <p>传真：021-33676520</p>
                    <p>ts@youzu.com</p>
                    <a>在线客服</a>
                </li>
                <li><span></span>未成年人<a>家长监护工程</a></li>
                <li><span></span><a>实名制</a>信息补填</li>
            </ul>
        </div>
    </div>
	<div class="left">U币兑换游戏币</div>
    <div class="left chu">
            <ul id="pay">
            <li class="pay_to">充值到：<a>U币</a><a class="pay_active">游戏</a></li>
            <li>充入账号：<input type="text" placeholder="账号"/></li>
            <li>选择游戏： <select>
                           <option>选择充值的游戏</option>
                       </select> 
                       <i></i>
                       <i></i>
                       <b> > </b>
                       <select>
                           <option>选择充值服务器</option>
                       </select>
            </li>
            <li>角色名：<input type="text" placeholder="你的名字"/>
                      <span>确认您要充值的角色是否正确</span>
            </li>
            <li>手机号码：<input type="text" placeholder="输入手机号"/>
                       <span>确认您要充值的角色是否正确</span>
            </li>
            <li class="pay_num">选择金额：<a>10元</a><a>50元</a><a class="pay_active">100元</a>
                       <a>500元</a><a>1000元</a><a>其他金额</a>
                       <span>单笔充值最少10元</span>
            </li>
            <li>将获得游戏币：<span></span></li>
            <hr />
            <li>选择银行卡：
                <ul>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_BOB.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_BOC.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_CCB.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_CEB.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_CITIC.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_CMB.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_CMBC.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_COMM.jpg"/></a></li>
                    <li><input type="radio" name="bank"/><a><img src="../img/game/bank_ICBC.jpg"/></a></li>
                </ul>
            </li>
            <li><input type="button" value="立即支付"/></li>
        </ul>
    </div>
    <div class="left">支付宝</div>
    <div class="left">微信支付</div>
    <div class="left">手机固话充值</div>
    <div class="left">游戏点卡充值</div>
    <div class="left">国际信用卡</div>
    <div class="left">短信支付</div>
    <div class="left">转账汇款</div>
    
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
<script src="../js/pay.js"></script>
<script src="../js/bg.js"></script>
</body>
</html>