<?php
$db_host = 'localhost';
$db_name = 'express01';
$db_user = 'shinder';
$db_pass = 'admin';

$dsn = sprintf('mysql:dbname=%s;host=%s', $db_name, $db_host);

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
} catch(PDOException $ex) {
    echo 'Connection failed:'. $ex->getMessage();

}



