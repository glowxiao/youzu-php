<?php
header("content-type:text/html;charset=utf8");
include_once 'function.php';
if(!empty($_GET)){
    $mysql=mysqli_connect('localhost', 'root', '', 'game');
    mysqli_set_charset($mysql, 'utf8');
    $zhanghao=get('zhanghao');
    $pwd=get('pwd');
    var_dump($pwd);
    $nickname=get('nickname');
    $queren=get('queren');
    var_dump($queren);
    $time=time();
    if($pwd==$queren){
        $sql="INSERT USER(account_id,pwd,create_time) VALUE('{$zhanghao }','{$pwd}','$time');
        INSERT message(account_id,nickname,create_time) VALUE('{$zhanghao}','{$nickname}','$time');";
        $re = mysqli_multi_query($mysql, $sql);
        if($re){
            header("location:index1.php");
        }else{
            echo '<script>alert("注册失败")</script>';
        }
    }else{
        echo '<script>alert("两次填写密码不一致，请重新输入！")</script>';
    }
    
}