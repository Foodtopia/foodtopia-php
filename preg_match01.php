<?php

$str = '0918-222-333';

// 手機號碼規則
$pattern = '/^09\d{2}\-?\d{3}\-?\d{3}$/';

// 符合回傳 1, 無符合回傳 0, pattern語法出錯回傳 false
echo preg_match($pattern, $str) ? 'ttt' : 'fff';
