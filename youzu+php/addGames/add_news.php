<?php
header("content-type:text/html;charset=utf-8");
include '../function.php';
date_default_timezone_set("Asia/Chongqing");
$mysql=mysqli_connect('localhost', 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$title=getPost('title');
$content=getPost('content');
/* $file=$_FILES['img'];
$type1=getPost('type1'); */
$type=getPost('type');
$time=time();
/*$path = "../img/news_img/";
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
    } else{
        $s_img = zoom($new_name, 100, 100,'../img/news_img/s/');
        zoom($new_name, 200, 200,'../img/news_img/m/');
    }
}else{
    $new_name = ''; 

}*/
/* $new_img =$new_name; */
$sql="INSERT news(news_title,news_type,news_content,create_time) VALUES('{$title}','{$type}','{$content}','$time');
";
$re=mysqli_multi_query($mysql, $sql);
if($re){
    header("location:addNews.php");

}else{
    echo '<script>alert("添加失败")</script>';
}
?>