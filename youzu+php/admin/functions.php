<?php
function checkLoginStatus(){
    $uid = cookie('uid');
    if(!empty($uid)){
        return $uid;
    }else{
        return false;
    }
}
function checkRole(){
    $role_id = $_SESSION['role']['rid'];
    $role = $_SESSION['role']['value'];
    $path = pathinfo($_SERVER['REQUEST_URI']);
    $dir_path = str_replace("/youzu/admin/", '', $path['dirname'])."/".$path['filename'];
    //var_dump($dir_path,$role);
    if($role_id == 1 || in_array($dir_path, $role)){
        return true;
    }else{
        return false;
    }
}
function getMemu(){
    $mysql = mysqli_connect("localhost", 'root', '', 'game');
    mysqli_set_charset($mysql, 'utf8');
    $sql = "SELECT * FROM menu WHERE status=1";
    $re = mysqli_query($mysql, $sql);
    $type = array();
    while ($data = mysqli_fetch_assoc($re)){
        $type[] = $data;
    }
    return $type;
}
function getSub($data){
    $temp = array();
    foreach ($data as $k=>$v){
        $temp[$v['mid']] = $v;
    }
    foreach ($temp as $k=>$v){
        if($v['pid'] == 0){
            continue;
        }
        $temp[$v['pid']]['sub'][] = $v;
        unset($temp[$k]);
    }
    return $temp;
}

/* function getAjaxPageParse($total, $page_num =20, $num = 3, $page = 'page'){
    $pageIndex = empty($_GET[$page]) ? 1 : intval($_GET[$page]);
    $pageCount = ceil($total/$page_num);
    if(empty($pageIndex) || $pageIndex <= 1 ){
        $pageIndex = 1;
    }elseif($pageIndex > $pageCount){
        $pageIndex = $pageCount;
    }
    //处理分页字符串
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
        $pageStr .= "<li class='first'><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=1'>首页</a></li>";
        $pageStr .= "<li class='previous'><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=".($pageIndex-1)."'>上一页</a></li>";
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
            $pageStr .= '<li class="page selected"><a onclick="getPage(this)" href="javascript:;" data-href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }else{
            $pageStr .= '<li class="page"><a onclick="getPage(this)" href="javascript:;" data-href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }
    }
    if($pageIndex == $pageCount){
        $pageStr .= "<li class='next'><a href='javascript:;'>下一页</a></li>";
        $pageStr .= "<li class='last'><a href='javascript:;'>尾页</a></li>";
    }else{
        $pageStr .= "<li class='next'><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=".($pageIndex+1)."'>下一页</a></li>";
        $pageStr .= "<li class='last'><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=$pageCount'>尾页</a></li>";
    }
    $pageStr = '<div class="pagenumQu"><ul>'.$pageStr.'</ul></div>';
    return array(
        'pageIndex'=>$pageIndex,
        'pageCount'=>$pageCount,
        'total'=>$total,
        'limit'=>$page_num,
        'pageStr'=>$pageStr
    );
} */
function getPageParse($total, $page_num =20, $num = 3, $page = 'page'){
    $pageIndex = empty($_GET[$page]) ? 1 : intval($_GET[$page]);
    $pageCount = ceil($total/$page_num);
    if(empty($pageIndex) || $pageIndex <= 1 ){
        $pageIndex = 1;
    }elseif($pageIndex > $pageCount){
        $pageIndex = $pageCount;
    }
    //处理分页字符串
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
/**
 * 获取文件内容
 * @param string $filename
 * @param string $mode
 * @return multitype:|multitype:string
 * @author Hhb 2017-09-09
 */
function getFileContents($filename, $mode = 'r'){
    if(empty($filename) || !is_file($filename)){
        return array();
    }
    $file = fopen($filename, $mode);
    $arr = array();
    while ($data = fgets($file)){
        if(strpos(trim($data),"#") === 0){
            continue;
        }
        $temp = explode("=", trim($data));
        $arr[trim($temp[0])] = trim($temp[1]);
    }
    fclose($file);
    return $arr;
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
 * 获取目录的内容
 * @param string $path
 * @return boolean|multitype:unknown
 */
function getDirContent($path){
    if(!is_dir($path)){
        return false;
    }
    /* $dir = opendir($path);
    $arr = array();
    while($content = readdir($dir)){
        if($content != '.' && $content != '..'){
            $arr[] = $content;
        }
    }
    closedir($dir); */
    $arr = array();
    $data = scandir($path);
    foreach ($data as $v){
        if($v != '.' && $v != '..'){
            $arr[] = $v;
        }
    }
    return $arr;
}
/**
 * TODO:起个名字
 * @param unknown $srcPath
 * @param unknown $dstPath
 * @return multitype:number
 */
function fileCopy($srcPath,$dstPath){
    $truePath = !empty($dstPath)? $dstPath."/" : '';
    if(!empty($truePath) && !is_dir($truePath)){
        mkdir($truePath,0777,true);
    }
    $data = getDirAllContents($srcPath);
    $i = $j = 0;
    foreach ($data as $v){
        if(is_file($v)){
            $i++;
            $data = file_get_contents($v);
            $temp = explode("/", $v);
            $temp = array_pop($temp);
            $ext = substr($temp,strrpos($temp,'.'));
            $name = substr($temp,0,strrpos($temp,'.'));
            $newname = $truePath.$name.'_s'.$ext;
            $re = file_put_contents($newname, $data);
            if($re){
                $j++;
            }
        }
    }
    return array('success'=>$j,'error'=>$i-$j,'total'=>$i);
}
/**
 * 获取目录的所有内容（目录及文件，包括子目录）
 * @param string $path
 * @return Ambigous <multitype:unknown , multitype:>
 */
function getDirAllContents($path){
    $arr = array();
    $arr[] = $path;
    if(is_file($path)){
    
    }else{
        if(is_dir($path)){
            $data = scandir($path);//. .. d j 3.txt
            if(!empty($data)){
                foreach ($data as $v){
                    if($v !='.' && $v!='..'){
                        $truePath = $path."/";
                        $temp = getDirAllContents($truePath.$v);
                        $arr = array_merge($arr,$temp);
                    }
                }
            }
        }
    }
    return $arr;
}
//c               //. .. d j 3.txt                    //  c
//    c/d         //. .. f g 1.txt                    //  c/d         
//        c/d/f   //. .. a                               // c/d/f
//            c/d/f/a //. ..                                 // c/d/f/a
//        c/d/g  //. .. 4.txt                                   // c/d/g
//              c/d/g/4.txt                                // c/d/g/4.txt
/* function getDirAllContents($path){
    echo $path."<br/>";
    if(is_file($path)){
        
    }else{
        if(is_dir($path)){
            $data = scandir($path);//var_dump($data);
            if(!empty($data)){
                foreach ($data as $v){
                    if($v !='.' && $v!='..'){
                        $truePath = $path."/";
                        getDirAllContents($truePath.$v);
                    }
                }
            }
        }
    }
    
} */
function pwdMD5($string){
    return md5(sha1("#!").sha1($string."@"));//md5(sha1("#!".$string."@"));
}
function post($key = null){
    if(!empty($key)){
        $return = isset($_POST[$key]) ? $_POST[$key] : '';
    }else{
        $return = $_POST;
    }
    return $return;
}
function get($key = null){
    if(!empty($key)){
        $return = isset($_GET[$key]) ? $_GET[$key] : '';
    }else{
        $return = $_GET;
    }
    return $return;
}
function cookie($key = null){
    if(!empty($key)){
        $return = isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
    }else{
        $return = $_COOKIE;
    }
    return $return;
}