<?php

require __DIR__. '/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM address_book");

$data_ar = $stmt->fetchAll();

echo json_encode($data_ar, JSON_UNESCAPED_UNICODE);

