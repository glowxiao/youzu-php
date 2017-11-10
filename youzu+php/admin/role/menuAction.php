<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$rid = get('rid');
$mid = get('mid');
$action = get('action');
if(empty($rid)|| empty($mid) ||empty($action)){
    header("location:list.php");
}
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
if($action == 'del'){
    $sql = "DELETE FROM r_menu WHERE role_id=$rid AND menu_id=$mid;";
}elseif($action == 'rel'){
    $sql ="INSERT r_menu(role_id,menu_id) VALUES($rid,$mid);";
}
$re = mysqli_query($mysql, $sql);
header("location:menuSetting.php?id=$rid");