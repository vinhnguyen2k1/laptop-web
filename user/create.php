<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/imgs/favicon/logo.png" />
    <title>Sell LapTop</title>
</head>

<body class="body-class">
    <!-- Login -->
    <?php
    include "../conect_db.php";
    $error = false;
    $errorPassword = false;
    $errorRePassword = false;
    if (isset($_GET['action']) && $_GET['action'] == 'create') {
        if(empty($_POST['password']))
        $errorPassword = "* bạn chưa nhập Mật khẩu.";
        $pattern = '/^[a-zA-Z0-9]+$/';
        $subject = $_POST['username'];
        if(empty($_POST['username']) || !preg_match($pattern, $subject, $matches)){
            $error = "*tài khoản không được có khoản cách và không được để trống.";
        }else{
            
            if (strlen($_POST['password']) < 7) {
                $errorPassword = '* mật khẩu phải ít nhất 7 ký tự.';
            }else if($_POST['password'] !== $_POST['repassword']){
            $errorRePassword = '* mật khẩu không giống nhau.';  
            } else {
                if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                    $result = mysqli_query($con, "INSERT INTO `user` (`idUser`, `username`, `password`, `status`, `creat_date`) VALUES (NULL, '" . $_POST['username'] . "', MD5('" . $_POST['password'] . "'), 'user', " . time() . ");");
                    // for data user
                    if (!$result) {
                        if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                            $error = "* Tài khoản đã tồn tại.";
                        }
                    }else{
                    $addi4 = mysqli_query($con,"SELECT * FROM `user`");
                    while($row = mysqli_fetch_array($addi4)){
                        if($row['username'] == $_POST['username']){
                            // add data i4user
                            mysqli_query($con, "INSERT INTO `i4user` (`idI4`, `idUser`, `email`, `fullname`, `address`, `phone`, `sex`) VALUES (NULL, '".$row['idUser']."', '', '', '', '', '');");
                        }
                    }
                }

                }

                
            }
        }
        mysqli_close($con);
        if ($error !== false || $errorPassword !== false || $errorRePassword !== false) {
    ?>
    <div class="body">
        <div class="grid">
            <div class="form-login">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <form class="form-flex" action="./create.php?action=create" method="Post" autocomplete="off">

                    <div class="form-login__input-size">

                        <input type="text" placeholder="User Name" name="username" class="form-login__input" value="">
                    </div>
                    <?php if ($error !== false) { ?>
                    <h3 class="error-i4"><?= $error ?>
                    </h3>
                    <?php } ?>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="Password" name="password" class="form-login__input"
                            value="">
                    </div>

                    <?php if ($errorPassword !== false) { ?>
                    <h3 class="error-i4">
                        <?= $errorPassword ?></h3>
                    <?php } ?>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="Password Again" name="repassword" class="form-login__input"
                            value="">
                    </div>
                    <?php if ($errorRePassword !== false) { ?>
                    <h3 class="error-i4">
                        <?= $errorRePassword ?></h3>
                    <?php } ?>
                    <input type="hidden" name="creat-ok" value="okok">
                    <div class="form-login__btn-size">
                        <input class="form-login__btn-style" type="submit" value="Đăng Ký">
                    </div>
                </form>
                <div class="clear"></div>
                <label class="form-login__Blank">bạn đã có tài khoản? <a href="../user/login.php"
                        class="form-login__Blank-a">Đăng Nhập</a></label>
            </div>
        </div>
    </div>
    <?php
        } else {
            session_start();
            $_SESSION['ok_creat'] = $_POST['creat-ok'];
        ?>
    <meta http-equiv="refresh" content="0;url=../index.php">
    <?php
        }
    } else {
        ?>
    <div class="body">
        <div class="grid">
            <div class="form-login">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <form class="form-flex" action="./create.php?action=create" method="Post" autocomplete="off">
                    <div class="form-login__input-size">

                        <input type="text" placeholder="User Name" name="username" class="form-login__input" value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="Password" name="password" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="Password Again" name="repassword" class="form-login__input"
                            value="">
                    </div>

                    <input type="hidden" name="creat-ok" value="okok">
                    <div class="form-login__btn-size">
                        <input class="form-login__btn-style" type="submit" value="Đăng Ký">
                    </div>
                </form>
                <div class="clear"></div>
                <label class="form-login__Blank">bạn đã có tài khoản? <a href="../user/login.php"
                        class="form-login__Blank-a">Đăng nhập</a></label>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
<style>
.error-i4 {
    width: 100%;
    padding: 2px 10px;
    color: red;
    margin-top: -10px;
    margin-bottom: 10px;
    font-weight: 400;
    border-radius: 5px;
}
</style>

</html>