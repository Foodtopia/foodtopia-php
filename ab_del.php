<?php
require __DIR__. '/__connect_db.php';

if(!isset($_GET['sid'])){
    exit;
    //die('Hello');
}
$sid =  intval($_GET['sid']);

$sql = "DELETE FROM `address_book` WHERE sid=$sid";

$stmt = $pdo->query($sql);

echo $stmt->rowCount();



