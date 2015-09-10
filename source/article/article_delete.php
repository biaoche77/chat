<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/28
 * Time: 14:13
 */



$aid    =   isset($_GET['aid']) ? $_GET['aid'] : 0;

$sql = "DELETE FROM"   .table('article_title') . "WHERE  `aid` = '$aid'";

$row = mysql_query($sql);

//print_r($row);
if($row){
   showMsg('deleted',url('article','index'));
}




