<?php

require __DIR__. '/__connect_db.php';
try {
    //$stmt = $pdo->query("SELECT * FROM address_book");
    $stmt = $pdo->query("SELECT `email`,`name` FROM address_book");
    //$stmt = $pdo->query("SELECT 2+3"); //測試除錯用

    //$data_ar = $stmt->fetchAll(); // 兩種都給
    //$data_ar = $stmt->fetchAll(PDO::FETCH_ASSOC); // 只給關聯式的陣列
    $data_ar = $stmt->fetch(PDO::FETCH_ASSOC); //一筆一筆拿

    echo json_encode($data_ar, JSON_UNESCAPED_UNICODE);
}catch (PDOException $ex){
    echo 'query failed:'. $ex->getMessage();
}


