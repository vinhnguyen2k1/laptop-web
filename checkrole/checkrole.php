<!-- check quyền -->
<?php
if (isset($_SESSION['current_user'])){
    if($_SESSION['current_user']['status'] == 'admin' || $_SESSION['current_user']['status'] == 'super'){
    }else{
        ?>
<meta http-equiv="refresh" content="0;url=../">
<?php
        exit;
    }
}else{
    ?>
<meta http-equiv="refresh" content="0;url=../user/login.php">
<?php
    exit;
}