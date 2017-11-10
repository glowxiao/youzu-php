 <?php
header("content-type:text/html;charset=utf-8");
/* include 'function.php';
date_default_timezone_set("Asia/Chongqing");
$mysql=mysqli_connect('localhost', 'root', '', 'games');
mysqli_set_charset($mysql, 'utf8');
$title=getPost('title');
$content=getPost('content');
$file=$_FILES['img'];
$type1=getPost('type1');
$type=getPost('type');
$time=time();
$path = "news/";
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
        }else{
            $s_img = zoom($new_name, 100, 100,'news/s/');
            zoom($new_name, 200, 200,'news/m/');
        }
    }else{
        $new_name = '';

}
$new_img =$new_name;
$sql="INSERT games(game_name,game_type,img,game_content,game_class) VALUES('{$title}','{$type1}','{$new_img}','{$content}','{$type}');
    ";
$re=mysqli_multi_query($mysql, $sql);
 if($re){
 header("location:shouye.php");

}else{
    echo '<script>alert("添加失败")</script>';
}  */




?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="../Common/jquery-1.10.2.min.js"></script>
<title>添加日志</title>
<style>
td{
	border:1px solid black;width:50px;height:50px;
}
</style>
</head>
<body>
<div class="main">
    <form action='add_news.php' method='post' enctype="multipart/form-data">
        <div><span>游戏名称:</span><input type='text' name='title'placeholder='标题'/></div>
       <div><span>选择方式:</span>
            <!-- <select name="type" id="type1">
                <option value='手机游戏' selected='selected'>手机游戏</option>
                <option value='休闲游戏'>休闲游戏</option>
                <option>页游</option>
            </select> --> 
            <input type='text' name='type'/></div>
        </div>   
        <div><span>图片:</span><input type='file' name='img'/></div>
        <div><span>游戏描述:</span><textarea rows="10" cols="30" name='content'></textarea></div>
        <div><span>选择类型:</span>
            <!-- <select name="type" id="type">
                <option>动作设计</option>
                <option>回合制</option>
                <option>角色扮演</option>
                <option>立体卡牌</option>
                <option>战争策略</option>
            </select>  -->
            <input type='text' name='type1'/></div>
         </div>   
        <div><input type='submit' name='submit'value='添加'/></div>        
    </form>
</div>
<script>

</script>
</body>
</html>