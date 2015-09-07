<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/29
 * Time: 15:02
 */

if(isset($_POST['submit']) && $_POST['submit'] == 'yes'   ){
    if($_SESSION['vdcode'] != $_POST['vdcode']){
        exit('验证码错误');
    }



    $username = $_POST['username'];
    $password = trim($_POST['password']);
    $confirmPassword = $_POST['confirmPassword'];

    if(empty($username)){
        exit("请填写用户名");
    }

    if(empty($password)){
        exit("请填写密码");
    }

    if($password!=$confirmPassword){
        exit('密码不一致');
    }

    $sql = " SELECT * FROM  `pre_member` WHERE  `username` =  '$username' LIMIT 1 ";

    $query = mysql_query($sql);

    //$user = mysql_fetch_assoc($query);

    //$_SESSION['username'] = $user['username'];

    if(mysql_num_rows($query)){
        exit('用户名'.$username.'已经被注册');
    }else{
        $sql = " INSERT INTO  `php_msg`.`pre_member` (";
        $sql.= " `username` ," ;
        $sql.= " `password` " ;
        $sql.= " ) VALUE (";
        $sql.= "'$username',";
        $sql.= "'$password'";
        $sql.= " )";

        $query = mysql_query($sql);
    }


  showMsg("注册成功",url('index'));


}else{
    head();
?>
    <form class="form-horizontal" method="post">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-3">
                <input name="username"  id="username" type="text" class="form-control" id="inputEmail3">
            </div>
            <div class="col-sm-3" id="usernameCheckResult">

            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-3">
                <input name="password" type="password" class="form-control" id="inputEmail3">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-3">
                <input name="confirmPassword" type="password" class="form-control" id="inputEmail3">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-3">
                <input id="vdcode" name="vdcode" type="text" class="form-control" id="inputEmail3">
            </div>
            <div class="col-sm-3">
                <img src="<?=url('misc','vdcode');?>" onclick="this.src='<?=url('misc','vdcode');?>&'+new Date().getTime()" />
            </div>
            <div class="col-sm-3" id="vdcodeCheckResult">

            </div>
        </div>
        <?=submit();?>
    </form>

    <script type="text/javascript">
         $(function(){

            $("#username").blur(function(){
                $.ajax({
                    type: "POST",
                    url: "<?=url('misc','ajax_username')?>",
                    data:{
                        username:$("#username").val()
                    },
                    success: function(data, textStatus){
                        $("#submit")[0].disabled = !data.errorCode;
                        $("#usernameCheckResult").html(data.errorMsg);
                    },
                    dataType:"json"
                });

            })

        });










        $(function(){

            $("#vdcode").blur(function(){
                $.ajax({
                    type: "POST",
                    url: "<?=url('misc','ajax_vdcode')?>",
                    data:{
                        vdcode:$("#vdcode").val()
                    },
                    success: function(data, textStatus){
                        $("#submit")[0].disabled = !data.errorCode;
                        $("#vdcodeCheckResult").html(data.errorMsg);
                    },
                    dataType:"json"
                });

            })

        })


    </script>


    <?php
    foot();
}
