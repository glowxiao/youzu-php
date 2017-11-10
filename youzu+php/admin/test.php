<?php
session_start();
include_once 'functions.php';
$name = get('name');
$pwd = get('pwd');
$mysql = mysqli_connect("localhost", 'root', '', 'game');
mysqli_set_charset($mysql, 'utf8');
$pwd = md5("#".sha1($pwd)."@");
$sql = "SELECT * FROM user WHERE account='{$name}' AND password = '{$pwd}';";
$re = mysqli_query($mysql, $sql);
$user = mysqli_fetch_assoc($re);
if(empty($user)){
    echo json_encode(array('status'=>-1,'msg'=>'账号或密码错误!'));
    exit();
}

setcookie("uid",$user['id'],time()+3600);
$sql_a = "SELECT r.rid,a.aid,a.url FROM role r, r_action ra, action a WHERE r.rid={$user['role_id']} AND r.rid=ra.role_id AND ra.action_id = a.aid;";
$re_a = mysqli_query($mysql, $sql_a);
$role = array();
while ($data = mysqli_fetch_assoc($re_a)){
    $role[] = $data;
}
$sql_m = "SELECT r.rid,m.* FROM role r, r_menu rm, menu m WHERE r.rid={$user['role_id']} AND r.rid=rm.role_id AND rm.menu_id = m.mid;";
$re_m = mysqli_query($mysql, $sql_m);
$menu = array();
while ($data = mysqli_fetch_assoc($re_m)){
    $menu[] = $data;
}
$menu = getSub($menu);
$_SESSION['role'] = $role;
$_SESSION['menu'] = $menu;
echo json_encode(array('status'=>1,'msg'=>'ok'));