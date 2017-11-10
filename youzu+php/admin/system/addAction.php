<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$title = post('title');var_dump($title);
$url = post('url');var_dump($url);
$action = post('action');var_dump($pid);
$icon = post('icon');var_dump($action);
$sorts = post('sorts');var_dump($sorts);
$pid = post('pid');var_dump($pid);
$time = time();var_dump($pid);
$sql = "INSERT menu(title,url,action,icon,sorts,pid,create_time,update_time) VALUES('$title','$url','$action','$icon',$sorts,$pid,$time,$time);";
$re = mysqli_query($mysql, $sql);
var_dump($re);
if($re){
    header("location:../main.php");
}else{
    /* header("location:add.php"); */
    echo '<script>alert("插入失败！")</script>';
}