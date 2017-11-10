<?php
include_once '../functions.php';
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$title = post('title');
$url = post('url');
$action = post('action');
$icon = post('icon');
$sorts = post('sorts');
$pid = post('pid');
$time = time();var_dump($pid);
$sql = "INSERT menu(title,url,action,icon,sorts,pid,create_time,update_time) VALUES('$title','$url','$action','$icon',$sorts,$pid,$time,$time);";
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:list.php");
}else{
    header("location:add.php");
}