<?php include '../checkrole/checklogin.php'; ?>
<?php include '../conect_db.php';
if(isset($_GET['i4user'])){
$user = mysqli_query($con,"SELECT * FROM `i4user`");
$error = "";
$agree = "";
if(!empty($_POST)){
    $checkEmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
    $checkPhone = '/^[0-9]+$/';
    if(preg_match($checkEmail,$_POST['email']) == 0)
    $error .= "Email. ";
    if(preg_match($checkPhone,$_POST['phone']) == 0 || strlen($_POST['phone']) > 11 || strlen($_POST['phone']) < 6)
    $error .= "Số điện thoại.";
    // fix address
    for($i=0;$i< strlen($_POST['address']);$i++){
        if($_POST['address'][$i] == "'" || $_POST['address'][$i] == '"')
    $error .= "Địa chỉ có (\",')";
        if($_POST['address'][$i] == ".")
        $_POST['address'][$i] = "^";
    }
    // fix email
    for($i=0;$i< strlen($_POST['email']);$i++){
    if($_POST['email'][$i] == ".")
    $_POST['email'][$i] = "-";
    }
    $email = $_POST['email'];
    // check database
    $i4 = $_SESSION['current_user'];
    while($row = mysqli_fetch_assoc($user)) 
    if($row['idUser'] == $i4['idUser']){
    if($error == ""){
        mysqli_query($con,"UPDATE `i4user` SET `email` = '".$email."', `fullname` = '".$_POST['fullname']."', `address` = '".$_POST['address']."', `phone` = '".$_POST['phone']."', `sex` = '".$_POST['radio']."' WHERE `i4user`.`idI4` = ".$row['idI4'].";");
        $agree = "Sửa thông tin thành công";
    }
    }
}
?>
<div class="form-edit-user">
    <div class="form-edit-header">
        <h1 class="edit-header-h1">Hồ Sơ Của Tôi</h1>
        <p class="edit-header-txt">Quản lý thông tin hồ sơ để bảo mật và đặt hàng cho tài khoản</p>
    </div>
    <?php if($error !== "") 
            echo  "<h1 class=\"title-error\">* ".$error." không đúng định dạng! </h1>";
    ?>
    <?php if($agree !== "") 
            echo  "<h1 class=\"title-agree\">* ".$agree."! </h1>";
            $user = mysqli_query($con,"SELECT * FROM `i4user`");
    ?>
    <?php foreach($user as $key => $row){
        if($row['idUser'] == $_SESSION['current_user']['idUser']){ 
        ?>
    <form action="" method="POST">
        <!-- item -->
        <div class="view-i4user-flex">
            <div class="i4user-item-left">
                <p class="i4user-item__txt">Tên</p>
            </div>
            <div class="i4user-item-right">
                <input type="text" name="fullname" class="i4user-input" value="<?=$row['fullname']?>">
            </div>
        </div>
        <!-- check email -->
        <?php
        for($i=0;$i< strlen($row['email']);$i++){
            if($row['email'][$i] == "-")
            $row['email'][$i] = ".";
        }
        ?>
        <!-- item -->
        <div class="view-i4user-flex">
            <div class="i4user-item-left">
                <p class="i4user-item__txt">Email</p>
            </div>
            <div class="i4user-item-right">
                <input required type="text" name="email" class="i4user-input" value="<?=$row['email']?>">
            </div>
        </div>
        <!-- check address -->
        <?php
        for($i=0;$i< strlen($row['address']);$i++){
            if($row['address'][$i] == "^")
            $row['address'][$i] = ".";
        }
        ?>
        <!-- item -->
        <div class="view-i4user-flex">
            <div class="i4user-item-left">
                <p class="i4user-item__txt">Địa chỉ</p>
            </div>
            <div class="i4user-item-right">
                <input required type="text" name="address" class="i4user-input" value="<?=$row['address']?>">
            </div>
        </div>
        <!-- item -->
        <div class="view-i4user-flex">
            <div class="i4user-item-left">
                <p class="i4user-item__txt">Số điện thoại</p>
            </div>
            <div class="i4user-item-right">
                <input type="text" required name="phone" class="i4user-input i4user-input__sdt"
                    value="<?=$row['phone']?>">
            </div>
        </div>
        <!-- item -->
        <div class="view-i4user-flex">
            <div class="i4user-item-left">
                <p class="i4user-item__txt">Giới Tính:</p>
            </div>
            <div class="i4user-item-right">
                <div class="radio-box">
                    <label for="nam">
                        <div class="radio-primaty">
                            <label for="nam">Nam</label>
                            <input type="radio" name="radio" id="nam" value="nam" <?php if($row['sex'] == 'nam') {?>
                                checked <?php } ?>>
                            <span class="checkmark"></span>
                        </div>
                    </label>
                </div>
                <div class="radio-box">
                    <label for="nu">
                        <div class="radio-primaty" for="nu">
                            <label for="nu">Nữ</label>
                            <input type="radio" name="radio" id="nu" value="nu" <?php if($row['sex'] == 'nu') {?>
                                checked <?php } ?>>
                            <span class="checkmark"></span>
                        </div>
                    </label>
                </div>
                <div class="radio-box">
                    <label for="khac" class="radio-item">
                        <div class="radio-primaty">
                            <label for="khac">Khác</label>
                            <input type="radio" name="radio" id="khac" value="khac" <?php if($row['sex'] == 'khac') {?>
                                checked <?php } ?>>
                            <span class="checkmark"></span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="i4user-submit">
            <input type="submit" value="Thay đổi" class="item-submit__btn">
        </div>
    </form>
    <?php } 
}?>
</div>
<?php } ?>
<style>
/* error */
.title-agree,
.title-error {
    text-align: center;
    margin-bottom: 26px;
    color: red;
}

.title-agree {
    color: green;
}

/* submit btn */
.item-submit__btn {
    border: none;
    background-color: var(--color-shop);
    color: white;
    padding: 10px 20px;
    margin-left: 17.5%;
}

.item-submit__btn:hover {
    opacity: .7;
}

/* div header */
.form-edit-header {
    padding: 15px 0;
    border-bottom: 1px solid #ddd;
    margin-bottom: 20px;
}

.edit-header-h1 {
    opacity: .7;
    font-size: 22px;
    margin-bottom: 10px;
}

.edit-header-txt {
    font-size: 16px;
    opacity: .7;
    margin-bottom: 5px;
}

/* radio */
.radio-box {
    display: inline-block;
    margin-right: 20px;
}

.radio-primaty {
    display: inline-block;
    align-items: center;
    position: relative;
    padding-right: 35px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


/*  */
.form-edit-user {
    margin: 10px 20px;
    width: 100%;
}

.view-i4user-flex {
    width: 70%;
    display: flex;
    margin-bottom: 20px;
}

.i4user-item-left {
    display: flex;
    width: 25%;
    align-items: center;
    justify-content: right;
}

.i4user-item__txt {
    opacity: .7;
    font-size: 15px;
    margin-right: 20px;
}

.i4user-item-right {
    width: 75%;
}

.i4user-input {
    padding: 8px 10px;
    width: 100%;
}

.i4user-input__sdt {
    width: 30%;
}

/* Hide the browser's default radio button */
.radio-primaty input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: -4px;
    right: 2px;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radio-primaty:hover input~.checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.radio-primaty input:checked~.checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;

}

/* Show the indicator (dot/circle) when checked */
.radio-primaty input:checked~.checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.radio-primaty .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
</style>
</style>