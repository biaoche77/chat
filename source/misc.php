<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/29
 * Time: 15:21
 */

$do = isset($_GET['do']) && in_array($_GET['do'],array('vdcode','ajax_vdcode','ajax_username','test',
'index')) ? $_GET['do'] :'index';

require (PATH_ROOT."/source/".$mod."/".$mod.'_'.$do.'.php');