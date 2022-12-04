<?php
    include '../checkrole/checkadmin.php';
    include "../conect_db.php";
    // pages
    if (!empty($_GET['limit']) && !empty($_GET['page'])) {
        $getLimit = $_GET['limit'];
        $getOffset = $_GET['page'];
        } else {
        $getLimit = 12;
        $getOffset = 1;
        }
        $offset = ($getOffset - 1) * $getLimit;
        $rowUser = mysqli_query($con, "SELECT * FROM `user` WHERE `status` LIKE 'super'")->num_rows;
        $totalpages = ceil($rowUser / $getLimit);
        if(!empty($_GET['page']) && $_GET['page'] < 0){
            $user = mysqli_query($con, "SELECT * FROM `user` WHERE `status` LIKE 'super' LIMIT ".$getLimit." OFFSET 1");
        }else
        $user = mysqli_query($con, "SELECT * FROM `user` WHERE `status` LIKE 'super' LIMIT ".$getLimit." OFFSET ".$offset."");
// xóa user
if (isset($_GET['delete_user']) && isset($_GET['id'])){
    $id=$_GET['id'];
    mysqli_query($con, "DELETE FROM `user` WHERE `user`.`idUser` = ".$id."");
    ?>
<meta http-equiv="refresh" content="0;url=./admin.php?listadmin">
<?php
}
?>
<div class="box-list">
    <div class="box-header">
        <div class="box-header__name">User Name</div>
        <div class="box-header__date">Date Create</div>
        <div class="box-header__fix">Fix</div>
        <div class="box-header__del">Del</div>
    </div>
    <?php foreach($user as $key => $value) { ?>
    <div class="box-header box-header-style">
        <div class="box-header__name style-boder"><?=$value['username']?></div>
        <div class="box-header__date style-boder"><?= date('d/m/Y H:i', $value['creat_date']) ?></div>
        <div class="box-header__fix style-boder"><a href="./edit_user.php?id=<?= $value['idUser'] ?>"
                class="style-fix_user">Fix</a></div>
        <div class="box-header__del style-boder"><a href="./admin.php?listadmin&delete_user&id=<?=$value['idUser']?>"
                class="style-delete_user">Del</a></div>
    </div>
    <?php } ?>
    <div class="box-list__pages">
        <?php include '../page.php';?>
    </div>
</div>
<style>
.style-boder {
    border-top: 1px solid #ccc;
    padding: 20px 0;
}

.box-list {
    width: 100%;
    background-color: #ecebeb;
    padding: 0px 0px 60px 0px;
    position: relative;
}

.box-list__pages {
    display: flex;
    width: 100%;
    justify-content: center;
    padding: 10px;
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
}

.box-header {
    background-color: var(--color-shop);
    padding: 10px 0;
    display: flex;
    color: white;
}

.box-header-style {
    padding: 0;
    background-color: white;
    color: black;
}


.box-header__name {
    display: flex;
    justify-content: center;
    width: 30%;
}

.box-header__date {
    justify-content: center;
    display: flex;
    width: 30%;
}

.box-header__fix {
    justify-content: center;
    display: flex;
    width: 20%;
}

.box-header__del {
    justify-content: center;
    display: flex;
    width: 20%;
}
</style>