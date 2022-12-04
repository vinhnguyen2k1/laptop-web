<?php
$nameLink = '?';
if(isset($_GET['discount'])){
    $nameLink = '?discount&';
}
if(isset($_GET['manufacturer'])){
    $nameLink = '?manufacturer='.$_GET['manufacturer'].'&';
}
if(isset($_GET['dsSpham'])){
    $nameLink = '?dsSpham&';
}
if(isset($_GET['orderlist'])){
    $nameLink = '?orderlist&';
}
if(isset($_GET['listuser'])){
    $nameLink = '?listuser&';
}
if(isset($_GET['listadmin'])){
    $nameLink = '?listadmin&';
}
// if(isset($_GET['form']) && isset($_GET['to'])){
//     $nameLink = '?form='.$_GET['form'].'&to='.$_GET['to'].'&';
// }
if ($getOffset > 3) {
?>
<a class="prnext-style list_pages-product" href="<?=$nameLink?>limit=<?= $getLimit ?>&page=1"><i
        class="fa-solid fa-backward"></i></a>

<?php
}
    ?>
<a class="prnext-style list_pages-product" href="<?=$nameLink?>limit=<?= $getLimit ?>&page=<?= $getOffset - 1 ?>"><i
        class="fa-solid fa-caret-left"></i></a>
<?php
for ($i = 1; $i <= $totalpages; $i++) {
    if ($i != $getOffset) {
        if ($i > $getOffset - 3 && $i < $getOffset + 3) {
    ?>
<a class="list_pages-product" href="<?=$nameLink?>limit=<?= $getLimit ?>&page=<?= $i ?>"><?= $i ?></a>
<?php
        }
    } else {
        ?>
<a style="background-color: black; color:white;" class="list_pages-product"
    href="<?=$nameLink?>limit=<?= $getLimit ?>&page=<?= $i ?>"><?= $i ?></a>
<?php
    }
}
        ?>
<a class="prnext-style list_pages-product" href="<?=$nameLink?>limit=<?= $getLimit ?>&page=<?= $getOffset + 1 ?>"><i
        class="fa-solid fa-caret-right"></i></a>
<?php
if ($getOffset < $totalpages - 3) {
    ?>
<a class="prnext-style list_pages-product" href="<?=$nameLink?>limit=<?= $getLimit ?>&page=<?= $totalpages ?>"><i
        class="fa-solid fa-forward"></i></a>
<?php
}
?>