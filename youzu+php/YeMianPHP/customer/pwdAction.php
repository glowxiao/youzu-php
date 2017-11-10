<?php
header("content-type:text/html;charset=utf-8");
include_once '../function.php';
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$ypwd=getPost('ypwd');
$xpwd=getPost('xpwd');
$qpwd=getPost('qpwd');
//登录
session_start();
if(isset($_SESSION["code"])){
    $zhanghao=$_SESSION['account_id'];
}
$sql1="select pwd from user where account_id='{$zhanghao}' and status=1;";
$re1=mysqli_query($mysql, $sql1);
$data1=mysqli_fetch_assoc($re1);
if($ypwd!=$data1['pwd']){
    echo '<script>alert("原始密码错误，请重新输入！")</script>';
    echo "<meta http-equiv='Refresh' content='0;URL=pwd.php'>";
}else if ($xpwd==$qpwd){
    $sql="update user set pwd='{$xpwd}' where account_id='{$zhanghao}' and status=1;";
    $re=mysqli_query($mysql, $sql);
    if($re){
        echo '<script>alert("修改成功！")</script>';
        echo "<meta http-equiv='Refresh' content='0;URL=../customer.php'>";
    } 
}else{
    echo '<script>alert("两次密码不一致，请重新输入！")</script>';
    echo "<meta http-equiv='Refresh' content='0;URL=pwd.php'>";
}
