<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/27
 * Time: 22:07
 */

require('core/core.php');

$mod = isset($_GET['mod']) && in_array($_GET['mod'],array('index','member','article','misc')) ? $_GET['mod'] :'index';


require (PATH_ROOT.'/source/'.$mod.'.php');