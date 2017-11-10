<?php
include_once '../functions.php';
header("content-type:text/html;charset=utf8");

$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$action = get('action');
$rid =get('id');
$time = time();
if(empty($action) || empty($rid)){
    header("location:list.php");
}
if($action == 'rel'){
    $sql = " UPDATE role SET status = 1,update_time = $time WHERE rid = $rid;";
}elseif ($action == 'del'){
    $sql = " UPDATE role SET status = 0,update_time = $time WHERE rid = $rid;";
}
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:list.php");
}else{
    echo "die";die();
}

?>