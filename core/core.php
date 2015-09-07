<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/27
 * Time: 22:07
 */
//设置时区
date_default_timezone_set('Asia/Shanghai');


//D:\wamp\www\msg
define('PATH_ROOT',dirname(dirname(__FILE__)));
//echo PATH_ROOT;exit;


define('IN_PHPMSG',true);

$config = require('config/config.php');

require (PATH_ROOT.'/core/function.php');
require (PATH_ROOT.'/core/function_db.php');

//连接数据库
$link = @mysql_connect($config['db_host'].":".$config['db_port'],$config['db_user'],$config['db_pass']) or die('#1 数据库连接失败');

@mysql_selectdb($config['db_name'],$link) or die('#2');

mysql_query(" SET NAMES utf8 ");


session_start();