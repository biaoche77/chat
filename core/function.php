<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/28
 * Time: 10:53
 */
function template($name){
    require (PATH_ROOT.'/template/'.$name.'.php');
}

function head(){
    template('head');
}
function foot(){
    template('foot');
}








function checkLogined($return = false){
    $boolean = isset($_SESSION['uid']) && $_SESSION['uid'];
    if($return){
        return $boolean;
    }else{
        if(!$boolean){
            showMsg('请登录系统',url('member','login'));
            exit;
        }
    }
}

function url($mod,$do=''){
    return 'index.php?mod='.$mod.'&do='.$do;
}



function showMsg($msg,$url){
    head();
    $html = '<div style="width:500px;margin:50px auto">';
    $html.= '<a href="">'.$msg.'</a>';
    $html.= '</div>
<script>
window.setTimeout(function(){
    window.location.href = "'.$url.'";
},3000)

</script>';

    echo $html;
    foot();


}

function submit(){
    $html = '<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="submit" type="submit" class="btn btn-default">提交</button>
                <input type="hidden" name="submit" value="yes">
            </div>
        </div>';
    echo $html;
}

function getResultNum($sql){
    $result = mysql_query($sql);
    return mysql_num_rows($result);
}

function fetchOne($sql){
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}


function fetchAll($sql){
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
        $rows[]=$row;
    }
    return $rows;
}


//$count为总条目数，$page为当前页码，$page_size为每页显示条目数<br />
function show_page($count,$page,$page_size)
{
    $page_count  = ceil($count/$page_size);  //计算得出总页数

    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;

    //判断当前页码
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI'];
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }

    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移量

    $navs='';
    if($pages != 0){
        if($page!=1){
            $navs.="<li><a href=\"".$url."page=1\">首页</a> </li>";        //第一页
            $navs.="<li><a href=\"".$url."page=".($page-1)."\"><span>&laquo;</span>
</a></li>"; //上一页
        } else {
            $navs .= "<li><span class='disabled'>首页</span></li>";
            $navs .= "<li><span class='disabled'>上页</span></li>";
        }
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计算
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<li class=\"active\"><span>".$i.'</span></li>';}
            else {$navs.="<li> <a href=\"".$url."page=".$i."\">".$i."</a></li>";}
        }
        if($page!=$pages)
        {
            $navs.="<li> <a href=\"".$url."page=".($page+1)."\"><span>&raquo;</span></a></li> ";//下一页
            $navs.="<li><a href=\"".$url."page=".$pages."\">末页</a></li>";    //最后一页
        } else {
            $navs .= "<li><span class='disabled'>下页</span></li>";
            $navs .= "<li><span class='disabled'>末页</span></li>";
        }
        echo "<ul class=\"pagination\">$navs</ul>";
    }
}