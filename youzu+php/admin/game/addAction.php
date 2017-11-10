<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$game_name = post('game_name');
$game_type = post('game_type');
$img = $_FILES['img'];
$tan_img = $_FILES['tan_img'];
$icon_img = $_FILES['icon_img'];
$game_content = post('game_content');
$game_class=post('game_class');
$time = time();
function mg($file){
    $path = "../../img/news_img/";
    if(!empty($file) && $file['error'] == 0){
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        switch($file['type']){
            case 'image/jpeg':
            case 'image/jpg':
                $ext='.jpg';
                break;
            case 'image/png':
                $ext='.png';
                break;
            case 'image/gif':
                $ext='.gif';
                break;
        }
        $new_name=$path.date("YmdHis").$ext;
        $re1 = move_uploaded_file($file['tmp_name'], $new_name);
        if(!$re1){
            $new_name = '';
        }
    }
    return $new_name;
}
$img=mg($img);
$tan_img=mg($tan_img);
$icon_img=mg($icon_img); 
$sql = "INSERT games(game_name,game_type,img,tan_img,icon_img,game_content,game_class,create_time) VALUES('$game_name','$game_type','$img','$tan_img','$icon_img','$game_content','$game_class','$time');";
var_dump($sql);
$re = mysqli_query($mysql, $sql);
if($re){
    header("location:../main.php");
}else{
    /* header("location:add.php"); */
    echo '<script>alert("插入失败！")</script>';
}