<?php include '../checkrole/checkrole.php'; ?>
<?php include '../conect_db.php';
$slider = mysqli_query($con, "SELECT * FROM `slider` ORDER BY `slider`.`idSlider` DESC");
if(isset($_POST['upSlider']) == 'Upload Slider'){
    if($_POST['slider-link'] !== ''){
        mysqli_query($con,"INSERT INTO `slider` (`idSlider`, `imgSlider`,`linkSlider`) VALUES (NULL, '".$_POST['slider-view']."', '".$_POST['slider-link']."');");
    }else
    mysqli_query($con,"INSERT INTO `slider` (`idSlider`, `imgSlider`,`linkSlider`) VALUES (NULL, '".$_POST['slider-view']."', '#');");
?>
<meta http-equiv="refresh" content="0;url=./admin.php?setslider">
<?php
}
if(isset($_GET['delete-slider'])){
mysqli_query($con, "DELETE FROM `slider` WHERE `slider`.`idSlider` = ".$_GET['delete-slider']."");
?>
<meta http-equiv="refresh" content="0;url=./admin.php?setslider"> <?php
}
?>
<div class="slider-form">
    <form action="" method="POST">
        <div class="slider-space">
            <div style="display:flex; width:100%; flex-wrap:wrap;">
                <div class="div-space__slider">
                    <span class="slider-span">
                        New Slider (*):
                    </span>
                    <input required class="slider-input" type="text" placeholder="Link ảnh cho slider"
                        name="slider-view">
                </div>
                <!-- thêm link slider -->
                <div class="div-space__slider">
                    <!-- <span class="slider-span">
                        Link:
                    </span> -->
                    <input class="slider-input" type="hidden" placeholder="Link liên kết với slider (có thể để trống)"
                        name="slider-link">
                </div>
            </div>
            <input class="slider-btn" type="submit" name="upSlider" value="Upload Slider">
        </div>
    </form>
    <div class="view-sliders view-sliders-nbder">
        <div class="slider-i4">
            <p class="slider-txt">Slider sẽ chạy từ ảnh mới nhất</p>
        </div>
    </div>
    <div class="view-sliders view-sliders-nbder">
        <div class="view-sliders__left-h">
            <p class="slider-txt">id Slider</p>
        </div>
        <div class="view-sliders__middle-h">
            <p class="slider-txt">Link ảnh Slider</p>
        </div>
        <div class="view-sliders__right-h">
            <p class="slider-txt">Ảnh</p>
        </div>
    </div>
    <div class="view-sliders__hidden">
        <?php while($row = mysqli_fetch_array($slider)){ ?>
        <div class="view-sliders">
            <div class="view-sliders__left">
                <p class="view-sliders__txt"><?=$row['idSlider']?></p>
            </div>
            <div class="view-sliders__middle">
                <a onclick="alert('Bạn đã xóa slider id[<?=$row['idSlider']?>]')"
                    class="view-sliders__txt view-sliders__link"
                    href="./admin.php?setslider&delete-slider=<?=$row['idSlider']?>">Xóa
                    Slider</a>
            </div>
            <div class="view-sliders__right">
                <img src=".<?=$row['imgSlider']?>" alt="slider-id(<?=$row['idSlider']?>)" class="sliders__right-img">
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<style>
/* i4 */
.slider-i4 {
    width: 100%;
    background-color: red;
    display: flex;
    justify-content: center;
    color: white;
    font-size: 20px;
    padding: 10px;
    margin-top: 10px;
}

/* view slider */
.view-sliders__hidden {
    max-height: 900px;
    overflow: hidden;
    overflow-y: scroll;
}

.view-sliders__hidden::-webkit-scrollbar {
    display: none;
}

.view-sliders {
    margin: 5px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom: 5px;
    border-bottom: 1px solid var(--color-shop);
}

.view-sliders-nbder {
    margin-bottom: 0;
    padding: 0;
    border: none;
}

.view-sliders__left-h,
.view-sliders__left {
    width: 10%;
    display: flex;
}

.view-sliders__middle-h,
.view-sliders__middle {
    width: 40%;
    display: flex;
}

.view-sliders__right-h,
.view-sliders__right {
    display: flex;
    width: 50%;
}

.view-sliders__middle-h,
.view-sliders__right-h,
.view-sliders__left-h {
    padding: 10px 0;
    display: flex;
    background-color: var(--color-shop);
    color: white;
}

.view-sliders__middle-h {
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}

.slider-txt {
    margin: auto;
}

.sliders__right-img {
    width: 100%;
    margin: auto;
}

.view-sliders__txt {
    margin: auto;
    font-size: 14px;
}

.view-sliders__link {
    text-decoration: none;
    color: white;
    background-color: red;
    padding: 10px 20px;
}

.view-sliders__link:hover {
    opacity: .7;
}

/*  */
.slider-form {
    width: 100%;
    margin: 20px;
}

.slider-space {
    border: 1px solid #ccc;
    padding: 10px;
    width: 100%;
}

.slider-span {
    font-size: 14px;
    margin-right: 10px;
}

.slider-input {
    width: 85%;
    padding: 5px 10px;
}

.slider-btn {
    margin-top: 20px;
    padding: 5px;
}

.div-space__slider {
    margin-bottom: 5px;
    display: flex;
    width: 100%;
    justify-content: space-between;
}
</style>