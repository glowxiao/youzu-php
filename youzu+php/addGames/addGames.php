 <?php
header("content-type:text/html;charset=utf-8");
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
    <form action='add_games.php' method='post' enctype="multipart/form-data">
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