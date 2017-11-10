<?php
include_once 'config.php';
/**
 * 类自动加载
 */
function __autoload($class){
    require_once "../class/".$class.".class.php";
}
function getPost($key = null){
    if(!empty($key)){
        $return = isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : '';
    }else{
        $return = $_POST;
    }
    return $return;
}
function get($key = null){
    if(!empty($key)){
        $return = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : '';
    }else{
        $return = $_GET;
    }
    return $return;
}

//连接的数据库
 function DB($host, $user, $password, $database,$char){
    $mysql=mysqli_connect($host, $user, $password, $database);
    mysqli_set_charset($mysql, $char);
    return $mysql;
} 
/**
 * 图片缩略
 * @param string $filename  图片文件路径
 * @param string $width     缩略宽
 * @param string $height    缩略高
 * @param string $path      图片保存目录路径
 * @return string           缩略图片文件路径
 */
function zoom($filename, $width, $height, $path = ''){
    $dst_w = $width;
    $dst_h = $height;
    $arr = getimagesize($filename);
    switch ($arr['mime']){
        case "image/png":
            $srcType = 'imagecreatefrompng';
            $outType = 'imagepng';
            break;
        case "image/jpg":
        case "image/jpeg":
            $srcType = 'imagecreatefromjpeg';
            $outType = 'imagejpeg';
            break;
        case "image/gif":
            $srcType = 'imagecreatefromgif';
            $outType = 'imagegif';
            break;
    }
    $src_im = $srcType($filename);
    $src_w = $arr[0];
    $src_h = $arr[1];
    $bili_w = $src_w/$dst_w;
    $bili_h = $src_h/$dst_h;
    if($src_w <= $dst_w && $src_h <= $dst_h){
        $true_w = $src_w;
        $true_h = $src_h;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }elseif($bili_w >= $bili_h){
        $true_w = $src_w/$bili_w;
        $true_h = $src_h/$bili_w;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }else{
        $true_w = $src_w/$bili_h;
        $true_h = $src_h/$bili_h;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }
    imagecopyresized($dst_im, $src_im, 0, 0, 0, 0, $true_w, $true_h, $src_w, $src_h);
    $temp = explode("/", $filename);
    $temp = array_pop($temp);
    $ext = substr($temp,strrpos($temp,'.'));
    $name = substr($temp,0,strrpos($temp,'.'));
    $truePath = !empty($path)? $path."/" : '';
    if(!empty($truePath) && !is_dir($truePath)){
        mkdir($truePath,0777,true);
    }
    $newname = $truePath.$name.'_s'.$ext;
    $outType($dst_im, $newname);
    return $newname;
}
/**
 * 数据库分页
 */
function getPageParse($total, $page_num =20, $num = 3, $page = 'page'){
    $pageIndex = empty($_GET[$page]) ? 1 : intval($_GET[$page]);
    $pageCount = ceil($total/$page_num);//总页数
    if(empty($pageIndex) || $pageIndex <= 1 ){
        $pageIndex = 1;
    }elseif($pageIndex > $pageCount){
        $pageIndex = $pageCount;
    }
    //处理分页字符串（获取localhost）
    if(isset($_SERVER['REQUEST_URI'])){
        $URI = $_SERVER['REQUEST_URI'];
    }else{
        if(isset($_SERVER['argv'])){
            $URI = $_SERVER['PHP_SELF']."?".$_SERVER['argv'][0];
        }else{
            $URI = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
        }
    }
    $url = stristr($URI,"?") ? substr($URI, 0,strpos($URI, '?')) : $URI;
    $get = '';
    $params = array($page);
    //？？？？
    foreach ($_GET as $k=>$v){
        if(in_array($k, $params)){
            continue;
        }
        $get .= "&".$k."=".$v;
    }
    $get = substr($get, 1) ? "?".substr($get, 1)."&" : "?";
    $url = $url.$get.$page;
    $pageStr = '';
    if($pageIndex == 1){
        $pageStr .= "<li class='first'><a href='javascript:;'>首页</a></li>";
        $pageStr .= "<li class='previous'><a href='javascript:;'>上一页</a></li>";
    }else{
        $pageStr .= "<li class='first'><a href='{$url}=1'>首页</a></li>";
        $pageStr .= "<li class='previous'><a href='{$url}=".($pageIndex-1)."'>上一页</a></li>";
    }
    $minNum = $pageIndex - $num;
    $maxNum = $pageIndex + $num;
    if($minNum < 1){
        $minNum = 1;
        $maxNum = $minNum + $num*2;
    }
    if($maxNum > $pageCount){
        $maxNum = $pageCount;
        $minNum = $maxNum - $num*2;
        $minNum = $minNum <=1 ? 1 : $minNum;
    }
    for ($i=$minNum;$i<=$maxNum;$i++){
        if($i == $pageIndex){
            $pageStr .= '<li class="page selected"><a href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }else{
            $pageStr .= '<li class="page"><a href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }
    }
    if($pageIndex == $pageCount){
        $pageStr .= "<li class='next'><a href='javascript:;'>下一页</a></li>";
        $pageStr .= "<li class='last'><a href='javascript:;'>尾页</a></li>";
    }else{
        $pageStr .= "<li class='next'><a href='{$url}=".($pageIndex+1)."'>下一页</a></li>";
        $pageStr .= "<li class='last'><a href='{$url}=$pageCount'>尾页</a></li>";
    }
    $pageStr = '<div class="pagenumQu"><ul>'.$pageStr.'</ul></div>';
    return array(
        'pageIndex'=>$pageIndex,
        'pageCount'=>$pageCount,
        'total'=>$total,
        'limit'=>$page_num,
        'pageStr'=>$pageStr
    );
}