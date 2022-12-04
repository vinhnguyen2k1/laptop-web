<!-- check login -->
<?php 
if (isset($_SESSION['current_user'])){
    
}else{
    ?>
<meta http-equiv="refresh" content="0;url=../user/login.php">
<?php 
exit;
}
?>