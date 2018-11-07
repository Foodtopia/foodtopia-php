<?php
require __DIR__. '/__connect_db.php';

$result = array(
    'success' => false,
    'resultCode' => 400,
    'errerMsg' => '沒有 sid 參數',
    'rowCount' => 0,
);

if(!isset($_GET['sid'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$sid =  intval($_GET['sid']);

$sql = "DELETE FROM `address_book` WHERE sid=$sid";

$stmt = $pdo->query($sql);

if($stmt->rowCount()==1){
    $result = array(
        'success' => true,
        'resultCode' => 200,
        'errerMsg' => '',
        'rowCount' => 1,
    );
} else {
    $result['resultCode'] = 402;
    $result['errerMsg'] = '資料沒有刪除';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

