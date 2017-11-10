<?php
header("content-type:text/html;charset=utf-8");
/**
 * 类自动加载
 */
function __autoload($class){
    require_once "class/".$class.".class.php";
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