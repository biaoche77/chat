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

    if(empty($username)){
        exit("请填写用户名");
    }

    if(empty($password)){
        exit("请填写密码");
    }



    $sql = " SELECT * FROM  `pre_member` WHERE  `username` =  '$username' LIMIT 1 ";

    $query = mysql_query($sql);

    $user = mysql_fetch_assoc($query);
//    print_r($user);exit;
//    Array ( [uid] => 2 [username] => 66 [password] => 6 )

    if($user['username'] != $username || $user['password'] != $password){
    exit("用户名或密码错误");
    }


    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['uid'] = $user['uid'];

    showMsg("登录成功",url('index'));





}else{
    head();
?>
    <form class="form-horizontal" method="post">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-3">
                <input name="username" type="text" class="form-control" id="inputEmail3">
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
