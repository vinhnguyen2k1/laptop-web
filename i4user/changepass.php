<?php include '../checkrole/checklogin.php'; ?>
<?php
    include "../conect_db.php";
    if (!empty($_SESSION['current_user'])) {
        $result = mysqli_query($con, "SELECT * FROM user");
        $error = false;
        $green = false;
        if(!empty($_POST)){
            if($_POST['password'] !== $_POST['repassword'])
            $error = "* Kiểm tra mật khẩu không giống nhau";
           
            if($error == false)
            while($row = mysqli_fetch_array($result)){
                if($row['idUser'] == $_SESSION['current_user']['idUser'])
                $green = "Thay đổi mật khẩu thành công!";
                mysqli_query($con,"UPDATE `user` SET `password` = '".$_POST['password']."' WHERE `user`.`idUser` = ".$_SESSION['current_user']['idUser']." AND `user`.`username` = '".$_SESSION['current_user']['username']."';");
            }
        }
    }
?>
<div class="body">
    <div class="grid">
        <div class="form-login" style="background-color: var(--white-color); padding:50px; padding-bottom:100px;">
            <div class="space-logo__login">
                <a href="../">
                    <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                </a>
            </div>
            <h1 style="margin-bottom: 30px; font-size:15px; text-transform:uppercase; text-align: center;">
                <?php if ($green == false) echo "Đổi mật khẩu thài khoản ".$_SESSION['current_user']['username']."";?>
            </h1>
            <form class="form-flex" action="" method="Post" autocomplete="off">
                <h1 style="text-align:center; margin-bottom:30px; color:green;">
                    <?php if ($green !== false) echo $green;?></h1>
                <p class="form-login__input-text" style="color:red;"><?php if ($error !== false) echo $error;?></p>
                <div class="form-login__input-size">

                    <input type="password" placeholder="New Password" name="password" class="form-login__input"
                        value="">
                </div>
                <div class="form-login__input-size">

                    <input type="password" placeholder="password again" name="repassword" class="form-login__input"
                        value="">
                </div>
                <div class="form-login__btn-size">
                    <input class="form-login__btn-style" type="submit" value="Thay đổi">
                </div>
            </form>
        </div>
    </div>
</div>