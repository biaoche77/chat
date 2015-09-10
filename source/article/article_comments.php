
<?php

checkLogined();

if(isset($_POST['submit'])){


    if($_POST['text'] == ""){
        echo "请输入内容";
    }else{
        $sql=mysql_connect("localhost","root","") or die("连接失败1");
        mysql_select_db("php_msg") or die ("连接失败2");
        mysql_query("SET NAMES 'utf8'");
        $newsid=$_POST['newsid'];
        $content=$_POST['text'];
        $date=date("y-m-d H:i");
        $sql="INSERT INTO `php_msg`.`com` ( `newsid`, `content`,`dates`)
        VALUES ( '$newsid', '$content', '$date')";
        mysql_query($sql);
        echo "<script>alert('评论成功');window.location.href='index.php?mod=article&do=view&aid=".$newsid."'</script>";



    }}

showMsg('发布成功',url('article'),'success');
?>
