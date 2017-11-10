<?php
session_start();
header("content-type:text/html;charset=utf8");
include_once 'function.php';
 $zhanghao1 = getPost('zhanghao1');
$pwd1 = getPost('pwd1');
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$sql = "SELECT * FROM user WHERE account_id='{$zhanghao1}' AND pwd = '{$pwd1}';";
$re = mysqli_query($mysql, $sql);
 $user = mysqli_fetch_assoc($re); 
 if(!empty($user)){
     header("location:index2.php");
     $_SESSION['account_id']=$zhanghao1;
     $_SESSION["code"]=mt_rand(0, 100000);//给session附一个随机值，防止用户直接通过调用界面访问index2.php 
 }else{
     echo '<script>alert("登录失败！")</script>';
    // header("location:index1.php");
     
 }
 
 
 //注销登录
 if($_GET['action'] == "logout"){
     unset($_SESSION['account_id']);
     echo '<script>alert("注销登录成功！")</script>';
     echo "<meta http-equiv='Refresh' content='0;URL=index.php'>"; 
     exit;
 }
?>



