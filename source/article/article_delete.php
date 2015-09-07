<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/28
 * Time: 14:13
 */
$aid    =   isset($_GET['aid']) ? $_GET['aid'] : 0;
$sql = ' DELETE * FROM '.table('article_title')." AS `t`";
$sql.= ' LEFT JOIN '.table('article_content')." AS `c` ";
$sql.= ' ON `t`.`aid` = `c`.`aid` ';
$sql.= " WHERE 1 ";
$sql.= " AND `t`.`aid` = $aid ";
if($_SESSION['uid'] != 3){
    $sql.= " AND t.`uid`='$_SESSION[uid]' ";
}
$query = mysql_query($sql);
$result = mysql_fetch_assoc($query);
echo $sql;