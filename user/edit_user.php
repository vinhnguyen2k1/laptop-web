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
    <?php
    session_start();
    include '../checkrole/checkrole.php';
    include "../conect_db.php";
    if (!empty($_SESSION['current_user'])) {
        $result = mysqli_query($con, "SELECT * FROM user");
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            // kiểm tra đổi tk cho admin
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                $resultUser = mysqli_query($con, "UPDATE `user` SET `username` = '" . $_POST['username'] . "' WHERE `user`.`idUser` = " . $_POST['user_id'] . ";");
                if (!$resultUser) {
                    if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                        $error = "tên tài khoản đã tồn tại";
                    }
                }
            }
            // kiểm tra đổi mk cho admin va user
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                if ($_POST['password'] !== $_POST['repassword']) {
                    $error = '* mật khẩu không giống nhau';
                }
            }
            if ($error !== false || $error !== false) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['idUser'] == $_POST['user_id']) {
                        $id = $row['idUser'];
    ?>
    <div class="body">
        <div class="grid">
            <div class="form-login" style="background-color: var(--white-color); padding:50px; padding-bottom:100px;">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <h1 style="margin-bottom: 30px; font-size:15px; text-transform:uppercase; text-align: center;">Đổi thông
                    tin tài khoản <?= $row['username'] ?></h1>
                <form class="form-flex" action="./edit_user.php?action=edit" method="Post" autocomplete="off">
                    <p class="form-login__input-text" style="color:red;"><?php if ($error !== false) echo $error;?></p>
                    <input type="hidden" name="user_id" value="<?= $id ?>">
                    <?php if ($_SESSION['current_user']['status'] == 'admin') { ?>
                    <div class="form-login__input-size">
                        <input type="text" placeholder="New User Name" name="username" class="form-login__input"
                            value="">
                    </div>
                    <?php } ?>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="New Password" name="password" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">
                        <input type="password" placeholder="password again" name="repassword" class="form-login__input"
                            value="">
                    </div>
                    <?php if ($_SESSION['current_user']['status'] == 'admin') { ?>
                    <div class="form-login__input-size">
                        <p class="form-login__input-text">Thêm Quyền:</p>
                        <select class="select-form__edit" name="status" id="">
                            <option value="user">User</option>
                            <option value="super">Super</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-login__btn-size">
                        <input class="form-login__btn-style" type="submit" value="Thay đổi">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
                    }
                }
            } else {
                if (isset($_POST['password']) && !empty($_POST['password'])) {
                    $resultPass = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['password'] . "') WHERE `user`.`idUser` = " . $_POST['user_id'] . ";");
                }
                if (isset($_POST['status']) && !empty($_POST['status'])) {
                    $resultPass = mysqli_query($con, "UPDATE `user` SET `status` = '" . $_POST['status'] . "' WHERE `user`.`idUser` = " . $_POST['user_id'] . ";");
                }
                ?>
    <div class="body">
        <div class="grid">
            <div class="form-login" style="background-color: var(--white-color); padding:50px; padding-bottom:100px;">
                <div class="space-logo__login">
                    <a href="../user/admin.php">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <h1 style="text-align:center; margin-bottom:30px; color:green;">Đổi thông tin thành công!</h1>
                <h3 style="text-align:center; margin-bottom:30px; color:red;">quay lại trang quản trị trong 2s nữa!</h3>
                <meta http-equiv="refresh" content="2;url=../user/admin.php">
            </div>
        </div>
    </div>
    <?php
            }
        } else {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['idUser'] == $_GET['id']) {
                    if ($_SESSION['current_user']['idUser'] == $_GET['id'] || $_SESSION['current_user']['status'] == 'admin') {
                ?>
    <div class="body">
        <div class="grid">
            <div class="form-login" style="background-color: var(--white-color); padding:50px; padding-bottom:100px;">
                <div class="space-logo__login">
                    <a href="../">
                        <img src="../assets/imgs/containerHeader/Logo.png" class="logo__Login" alt="">
                    </a>
                </div>
                <h1 style="margin-bottom: 30px; font-size:15px; text-transform:uppercase; text-align: center;">Đổi thông
                    tin tài khoản <?= $row['username'] ?></h1>
                <form class="form-flex" action="./edit_user.php?action=edit" method="Post" autocomplete="off">
                    <input type="hidden" name="user_id" value="<?= $_GET['id'] ?>">
                    <?php
                                        if ($_SESSION['current_user']['status'] == 'admin') {
                                        ?>
                    <div class="form-login__input-size">

                        <input type="text" placeholder="New User Name" name="username" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="New Password" name="password" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="password again" name="repassword" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">
                        <p class="form-login__input-text">Thêm Quyền:</p>
                        <select class="select-form__edit" name="status" id="">
                            <?php if ($row['status'] == 'admin') { ?>
                            <option value="admin">Admin</option>
                            <option value="super">Super</option>
                            <option value="user">User</option>
                            <?php } else if($row['status'] == 'user') { ?>
                            <option value="user">User</option>
                            <option value="super">Super</option>
                            <option value="admin">Admin</option>
                            <?php }else{
                                ?>
                            <option value="super">Super</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <?php } else { ?>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="New Password" name="password" class="form-login__input"
                            value="">
                    </div>
                    <div class="form-login__input-size">

                        <input type="password" placeholder="password again" name="repassword" class="form-login__input"
                            value="">
                    </div>
                    <?php } ?>
                    <div class="form-login__btn-size">
                        <input class="form-login__btn-style" type="submit" value="Thay đổi">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
                    }
                }
            }
        }
    } else { ?>
    <meta http-equiv="refresh" content="0;url=./login.php">
    <?php
    }

    ?>

</body>
<!-- style create -->
<style>
.select-form__edit {
    padding: 5px 20px;
}
</style>


</html>