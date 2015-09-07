<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/30
 * Time: 14:48
 */

if(isset($_POST['vdcode']) && strtolower($_POST['vdcode']) == $_SESSION['vdcode']){
    $array = array(
        'errorCode' => 1,
        'errorMsg' => '输入正确'
    );
}else{
    $array = array(
        'errorCode' => 0,
        'errorMsg' => '验证码错误'
    );
}
echo json_encode($array);