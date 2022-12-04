<?php include './conect_db.php';
$slider = mysqli_query($con, "SELECT * FROM `slider` ORDER BY `slider`.`idSlider` DESC");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
<div class="container-personal container__banner-body">
    <div class="container__banner">
        <div class="song-side__slide">
            <?php while($row = mysqli_fetch_array($slider)){
                // đang lỗi
                $url = $row['linkSlider'];?>
            <a href="<?=$url?>" class="song-side__item" style="background-image: url(<?=$row['imgSlider']?>);"></a>
            <?php } ?>
        </div>
    </div>
</div>
<div class="slide-buttons">
    <button id="slide-button__prev"><i class="bi bi-chevron-compact-left"></i></button>
    <button id="slide-button__next"><i class="bi bi-chevron-compact-right"></i></button>
</div>
<script>
let setTimeInterval = 6000;
let repeat = setInterval(() => {
    document.getElementById('slide-button__next').click();
}, setTimeInterval);

document.getElementById('slide-button__next').onclick = () => {
    let lists = document.querySelectorAll('.song-side__item');
    document.querySelector('.song-side__slide').appendChild(lists[0]);
    clearInterval(repeat);
    repeat = setInterval(() => {
        document.getElementById('slide-button__next').click();
    }, setTimeInterval);
};

document.getElementById('slide-button__prev').onclick = () => {
    let lists = document.querySelectorAll('.song-side__item');
    document.querySelector('.song-side__slide').prepend(lists[lists.length - 1]);
    clearInterval(repeat);
    repeat = setInterval(() => {
        document.getElementById('slide-button__next').click();
    }, setTimeInterval);
};
</script>
<style>
.container__banner-body {
    overflow: hidden;
}

.container__banner {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    display: flex;
    /* justify-content: center; */
}

.song-side__slide {
    width: max-content;
    box-shadow: 0 0px 3px #888;
}

.song-side__item {
    width: 100%;
    height: 450px;
    background-size: 100% 100%;
    display: inline-block;
    transition: 1s;
    position: absolute;
    z-index: 1;
    /* border-radius: 10px; */
}

/* .song-side__item:nth-child(1) {
	transform: translate(211%);
	background-position: 0% 50%;
	z-index: 4;
	visibility: hidden;
}

.song-side__item:nth-child(2) {
	transform: translate(-2%);
	background-position: 20% 50%;
	z-index: 4;
}

.song-side__item:nth-child(3) {
	transform: translate(104%);
	background-position: 50% 50%;
	z-index: 3;
}

.song-side__item:nth-child(4) {
	transform: translate(211%);
	background-position: 80% 50%;
	z-index: 2;
}

.song-side__item:nth-child(n + 5) {
	transform: translate(-2%);
	background-position: 100% 50%;
	z-index: 1;
	visibility: hidden;
} */

.song-side__item:nth-child(1) {
    transform: translate(0);
    background-position: 0% 50%;
}

.song-side__item:nth-child(n + 2) {
    transform: translate(0);
    background-position: 0% 50%;
    opacity: 0;
}



.song-side__item:hover {
    /* background-size: 102% 102%; */
}

.slide-buttons {
    position: absolute;
    bottom: +18%;
    text-align: center;
    width: 10%;
}

.slide-buttons {
    opacity: .2;
    display: flex;
    padding: 0 10px;
    transform: translatey(-250%);
    justify-content: space-between;
    z-index: 2;
    width: 100%;
}

.slide-buttons button {
    cursor: pointer;
    background-color: var(--color-shop);
    box-shadow: 0 2px 4px 0 rgb(226 102 102 / 15%);
    color: var(--white-color);
    font-size: 2.4rem;
    font-weight: 300;
    width: 50px;
    height: 50px;
    /* border-radius: 50%; */
    border: 1px solid var(--color-shop);
    transition: 0.5;
}


.slide-buttons button:hover {
    background-color: hsla(0, 0%, 100%, 0.3);
    color: var(--primary-color);
}
</style>