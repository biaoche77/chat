<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/30
 * Time: 16:32
 */
 yhrequire (PATH_ROOT.'/source/member/member_register.php');


if(isset($_POST['username']) &&  $_POST['username'] != $_SESSION['username']){
    $array = array(
        'errorCode' => 1,
        'errorMsg' => '用户名未被注册'
    );
}else{
    $array = array(
        'errorCode' => 0,
        'errorMsg' => '用户名已被注册'
    );
}
echo json_encode($array);