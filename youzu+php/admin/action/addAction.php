<?php
header("content-type:text/html;charset=utf-8");
session_start();
include_once '../functions.php';
$uid = checkLoginStatus();
if(empty($uid)){
    header('location:../login.php');exit();
}
$c_role = checkRole();
if(!$c_role){
    header("location:../error.php");exit();
}

$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$remark = post('remark');
$url = post('url');
$time = time();
$sql = "INSERT action(remark,url,create_time,update_time) VALUES('$remark','$url',$time,$time);";
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:list.php");
}else{
    header("location:add.php");
}