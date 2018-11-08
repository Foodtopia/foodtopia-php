<?php

echo $_SERVER['REQUEST_METHOD'];


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

