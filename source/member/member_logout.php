90<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/29
 * Time: 15:02
 */

unset($_SESSION['uid'],$_SESSION['username']);


showMsg('退出成功',url('index'),'success');