<?php
header("content-type:text/html;charset=utf-8");
include '../function.php';
date_default_timezone_set("Asia/Chongqing");
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$title=getPost('title');
$content=getPost('content');
$type=getPost('type');
$time=time();
$sql="INSERT qufu(game_id,service_name,open_time,create_time) VALUES('{$title}','{$type}','{$content}','$time');";
var_dump($sql);
$re=mysqli_multi_query($mysql, $sql);
if($re){
    header("location:addQuFu.php");

}else{
    echo '<script>alert("添加失败")</script>';
}

?>