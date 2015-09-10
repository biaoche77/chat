<?php
checkLogined();

$aid    =   isset($_GET['aid']) ? $_GET['aid'] : 0;
$op     =   isset($_GET['op'])
&& $_GET['op'] == 'update'
&& $aid
    ?'update':'create';

$result = array();

if($op == 'update'){
    $sql = ' SELECT * FROM '.table('article_title')." AS `t`";
    $sql.= ' LEFT JOIN '.table('article_content')." AS `c` ";
    $sql.= ' ON `t`.`aid` = `c`.`aid` ';
    $sql.= " WHERE 1 ";
    $sql.= " AND `t`.`aid` = $aid ";
    if($_SESSION['uid'] != 1){
        $sql.= " AND t.`uid`='$_SESSION[uid]' ";
    }
    $query = mysql_query($sql);
    $result = mysql_fetch_assoc($query);


//    if(empty($result)){
//        showMsg('要编辑的数据不存在或者你没有权限',url('article','index'));
//    }
}


if (isset($_POST['submit']) && $_POST['submit'] == 'yes') {
    //处理数据







    //1. 校验数据

    $insert['title'] = $_POST['title'];
    $insert['desc'] = $_POST['desc'];
    $insert['shop_price'] = $_POST['shop_price'];
    $insert['market_price'] = $_POST['market_price'];
    $insert['uid'] = $_SESSION['uid'];
    $insert['username'] = $_SESSION['username'];
    $insert['created_at'] = $insert['updated_at'] = TIMESTAMP;


    if(empty($insert['title'])){
        exit('请输入商品标题');
    }

    print_r($_POST['desc']);

    if($op == 'update'){

        //$sql="UPDATE `pre_article_title` SET title= '".$_POST['title']. "' WHERE aid=".$aid;

        //$sql="UPDATE `pre_article_title` SET desc= '".$_POST['desc']. "' WHERE aid= $aid";
        //$sql = "UPDATE  `php_msg`.`pre_article_title` SET  `desc` =  '".$_POST['desc']."' WHERE  `pre_article_title`.`aid` ='$aid'";


         $sql=  "UPDATE  `php_msg`.`pre_article_title` SET  `title` =  '".$insert['title']."',
`desc` =  '".$insert['desc']."',
`shop_price` =  '".$insert['shop_price']."'  WHERE  `pre_article_title`.`aid` ='$aid'";


        $sql2="UPDATE `pre_article_content` SET content= '".$_POST['content']. "' WHERE aid= $aid";






        $query= mysql_query($sql);

        $query= mysql_query($sql2);

    }else{
        $content['aid'] = insert('article_title',$insert);
        $content['content'] = $_POST['content'];
        $content['pid'] = 0;
        insert('article_content',$content,0);
    }





    showMsg('发布成功',url('article'),'success');
} else {
    //显示界面
    head();
    ?>
    <form class="form-horizontal" method="post">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">文章标题</label>

            <div class="col-sm-10">
                <input name="title" value="<?=showResult($result,'title')?>" type="text" class="form-control" id="inputEmail3">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">文章简介</label>

            <div class="col-sm-10">
                <textarea name="desc" class="form-control" rows="3"> <?=showResult($result,'desc')?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">本店价</label>

            <div class="col-sm-10">
                <input name="shop_price" value="<?=showResult($result,'shop_price')?>" type="text" class="form-control" id="inputEmail3">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">市场价</label>
            <div class="col-sm-10">
                <input name="market_price" value="<?=showResult($result,'market_price')?>" type="text" class="form-control" id="inputEmail3">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">文章详情</label>

            <div class="col-sm-10">
                <textarea name="content" class="form-control" rows="5"><?=showResult($result,'content')?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
                <input type="hidden" name="submit" value="yes">
            </div>
        </div>
    </form>
    <?php
    foot();
}
?>
	
	
	
