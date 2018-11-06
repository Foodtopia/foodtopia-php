<?php
require __DIR__. '/__connect_db.php';

if(!isset($_GET['sid'])){
    //echo 'no sid param!';
    exit;
    //die('Hello');
}
$sid =  intval($_GET['sid']);

$sql = "DELETE FROM `address_book` WHERE sid=$sid";

$stmt = $pdo->query($sql);

//echo $stmt->rowCount();
if(isset($_SERVER['HTTP_REFERER'])){
    // 從哪裡來, 從哪裡回去
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ab_list.php'); // 回到列表頁的第一頁
}



