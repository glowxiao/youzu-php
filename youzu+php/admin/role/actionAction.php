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
$rid = get('rid');
$aid = get('aid');
$action = get('action');
if(empty($rid)|| empty($aid) ||empty($action)){
    header("location:list.php");
}
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
if($action == 'del'){
    $sql = "DELETE FROM r_action WHERE role_id=$rid AND action_id=$aid;";
}elseif($action == 'rel'){
    $sql ="INSERT r_action(role_id,action_id) VALUES($rid,$aid);";
}
$re = mysqli_query($mysql, $sql);
header("location:actionSetting.php?id=$rid");