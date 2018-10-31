<?php

$ar2 = array(
        'name' => '小明',
        'age' => 24,
        'gender' => 'male',
    123,
    456,
);

echo json_encode($ar2, JSON_UNESCAPED_UNICODE);

echo count($ar2);
