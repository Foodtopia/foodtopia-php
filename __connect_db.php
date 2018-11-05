<?php
$db_host = 'localhost';
$db_name = 'express01';
$db_user = 'shinder';
$db_pass = 'admin';

$dsn = sprintf('mysql:dbname=%s;host=%s', $db_name, $db_host);

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // 連線使用的編碼設定
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $ex) {
    echo 'Connection failed:'. $ex->getMessage();
}



