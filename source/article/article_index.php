<?php
head();
?>
    <table class="table">
        <tr>
            <th>文章标题</th>
            <th>发布时间</th>
            <th>作者</th>
            <th>查看数</th>
            <th>操作</th>
        </tr>
        <?php




        $page = isset($_GET['page']) ? max(1,$_GET['page']) : 1;

        $offset = 2;

        $start = ($page - 1) * $offset;

        $where = " LIMIT $start,$offset ";

        $sql = ' SELECT COUNT(`aid`)  FROM '.table('article_title');
        $sql.= ' ORDER BY `created_at` DESC LIMIT 1 ';
        $query = mysql_query($sql);

        $totalCount = mysql_result($query,0);

        //查询数据

        $sql = ' SELECT * FROM '.table('article_title');
        $sql.= ' ORDER BY `aid` DESC ';
        $sql.= $where;

        $query = mysql_query($sql);

        ?>


        <?php while($row = mysql_fetch_assoc($query)): ?>
            <tr>
                <td>
                    <a href="<?=url('article','view')?>&aid=<?=$row['aid']?>"><?=$row['title']?></a>
                </td>
                <td><?=date('Y-m-d H:i',$row['created_at'])?></td>
                <td><?=$row['username']?></td>
                <td><?=$row['view_count']?></td>
                <td>
                    <a href="<?=url('article','create')?>&aid=<?=$row['aid']?>&op=update">编辑</a>
                    <a href="<?=url('article','delete')?>&aid=<?=$row['aid']?> ">删除</a>
                </td>
            </tr>
        <?php endwhile;?>
    </table>
<?php show_page($totalCount,$page,$offset)?>





<?php
foot();









//if(isset($_POST['searchBtn'])&& $_POST['searchBtn']=='yes' ){
//    $search="SELECT *
//FROM  `pre_article_content`
//WHERE  `content` LIKE  '%".$_POST['search'].""%'
//LIMIT 0 , 30";
//
//
//}

