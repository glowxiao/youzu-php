<?php
header("content-type:text/html;charset=utf-8");
include_once '../../function.php';
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$id=get('id');
var_dump($id);
$action=get("action");
if(empty($id)||empty($action)||!in_array($action, array('del','rel'))){
    echo "<script>alert('参数异常！');window.location.href='list.php';</script>";
}else if($action=='del'){
    $sql = "UPDATE games SET STATUS=0 WHERE game_id='{$id}';";
}elseif($action=="rel"){
    
    $sql = "UPDATE games SET STATUS=1 WHERE game_id='{$id}';";
    
}
var_dump($sql);
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:list.php");
}else{
    echo "<script>alert('操作失败！');window.location.href='list.php';</script>";
}
