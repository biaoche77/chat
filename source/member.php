<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/27
 * Time: 22:08
 */

$do = isset($_GET['do']) && in_array($_GET['do'],array('login','register','logout' )) ? $_GET['do'] :'index';

require (PATH_ROOT."/source/".$mod."/".$mod.'_'.$do.'.php');