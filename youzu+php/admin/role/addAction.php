<?php
include_once '../functions.php';
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$name = post('name');
$time = time();
$sql = "INSERT role(name,create_time,update_time) VALUES('$name',$time,$time);";
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:list.php");
}else{
    header("location:add.php");
}