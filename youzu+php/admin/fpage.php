<?php
function getAjaxPageParse($total, $page_num =20, $num = 3, $page = 'page'){
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
        $pageStr .= "<li class='first '><a href='javascript:;'>首页</a></li>";
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
            $pageStr .= '<li class="page active"><a onclick="getPage(this)" href="javascript:;" data-href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }else{
            $pageStr .= '<li class="page"><a onclick="getPage(this)" href="javascript:;" data-href="'.$url.'='.$i.'">'.$i.'</a></li>';
        }
    }
    if($pageIndex == $pageCount){
        $pageStr .= "<li class='next '><a href='javascript:;'>下一页</a></li>";
        $pageStr .= "<li class='last'><a href='javascript:;'>尾页</a></li>";
    }else{
        $pageStr .= "<li class='next '><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=".($pageIndex+1)."'>下一页</a></li>";
        $pageStr .= "<li class='last'><a onclick='getPage(this)' href='javascript:;' data-href='{$url}=$pageCount'>尾页</a></li>";
    }
    $pageStr = '<div class="pagenumQu"><ul class="pagination pull-right no-margin">'.$pageStr.'</ul></div>';
    return array(
        'pageIndex'=>$pageIndex,
        'pageCount'=>$pageCount,
        'total'=>$total,
        'limit'=>$page_num,
        'pageStr'=>$pageStr
    );
}