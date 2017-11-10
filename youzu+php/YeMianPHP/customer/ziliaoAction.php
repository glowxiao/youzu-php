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

$nickname=getPost('nickname');
$sex=getPost('sex');
$QQ=getPost('QQ');
$xueli=getPost('xueli');
$sheng=getPost('sheng');
$sql2="select sheng_name from sheng where sheng_id='{$sheng}';";
$re2=mysqli_query($mysql, $sql2);
$sheng2=mysqli_fetch_assoc($re2);

$city=getPost('city');
$sql="update message set nickname='{$nickname}',QQ='{$QQ}',sex='{$sex}',xueli='{$xueli}',province='{$sheng2['sheng_name']}',city='{$city}' where account_id='{$zhanghao}';";
$re=mysqli_query($mysql, $sql);
if($re){
    echo '<script>alert("修改成功！")</script>';
     echo "<meta http-equiv='Refresh' content='0;URL=ziliao.php'>"; 
}else{
    echo '<script>alert("修改失败")</script>';
    echo "<meta http-equiv='Refresh' content='0;URL=ziliaoEdit.php'>"; 
}

