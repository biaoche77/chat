<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/9/7
 * Time: 10:32
 */
head();
$sql = 'SELECT * FROM' .table('article_title');
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
?>


<h1><?=$result['title']?></h1>








<?php
foot();