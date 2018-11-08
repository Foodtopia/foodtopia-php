<?php

// 取得 http request 傳入的 body 資料
$entityBody = file_get_contents('php://input');

// 把文字解析成 PHP 關聯式陣列
$bdata = json_decode($entityBody, true);

$result['method'] = $_SERVER['REQUEST_METHOD'];
foreach($bdata as $k=>$v){
    $result[$k] =$v;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);


/*
switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        echo '取得資料';
        break;
    case 'POST':
        echo '張貼';
        break;
    case 'PUT':
        echo '更改';
        break;
    case 'DELETE':
        echo '刪除';
        break;

}
*/
