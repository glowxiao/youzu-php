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
    <form action='add_qufu.php' method='post' enctype="multipart/form-data">
        <div><span>游戏id:</span><input type='text' name='title'placeholder='标题'/></div>
          <div> <span>区服名称:</span> <input type='text' name='type'/></div>
        </div>   
        
        <div><span>开服时间:</span>         <input type='text' name='content'/></div></div>  
        <div><input type='submit' name='submit'value='添加'/></div>        
    </form>
</div>
<script>

</script>
</body>
</html>