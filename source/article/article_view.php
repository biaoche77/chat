<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/9/7
 * Time: 10:32
 */





head();

$aid    =   isset($_GET['aid']) ? $_GET['aid'] : 0;

$sql = ' SELECT * FROM '.table('article_title');
$sql.= 'where aid ='.$aid ;
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);



$sql1 = ' SELECT * FROM '.table('article_content');
$sql1.= 'where aid ='.$aid ;
$query1 = mysql_query($sql1);
$row1 = mysql_fetch_assoc($query1);

$sql2 = ' SELECT * FROM '.table('member');
$sql2.= 'where uid ='.$_SESSION['uid'] ;
//echo $sql2;
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_assoc($query2);
//print_r($row2['username']);



//查询相同id字段里面的评论

$sql="SELECT *
FROM  `com`
WHERE  `newsid` = $aid
ORDER BY  `postID` DESC ";
$sel=mysql_query($sql);

?>

<h1><?=$row['title']?></h1>

<P><?=$row1['content']?></P>

<style>
    h3{font-size:14px}
    #comments{margin:10px auto}
    #post{margin-top:10px}
    #comments p,#post p{line-height:30px}
    #comments p span{margin:4px; color:#999}
    #message{position:relative; display:none; margin-top:-100px; margin-left:30px;
        background:#369; color:#fff; z-index:1001}
</style>


    <form action="index.php?mod=article&do=comments" method="post">
        <h2>评论</h2><br/>
        <textarea cols="60" rows="10" name="text"></textarea>
        <input type="hidden" value="<?php echo $aid?>" name="newsid"/>
        <input type="submit" value="发表" name="submit"/>
    </form>
<div>
    <?php while($row=mysql_fetch_assoc($sel)):?>

        <li class="ls" style="list-style: none">
           评论人： <?php echo $row2['username'];?><br/>
            评论内容：<?php echo $row["content"];?><br/>
            评论时间：<?php echo $row['dates'];?>
            <?php   echo "<hr/>"?>
        </li>
    <?php endwhile;?>

</div>







<?php
foot();









