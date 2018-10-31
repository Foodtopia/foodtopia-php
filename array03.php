<?php

$ar2 = array(
        'name' => '小明',
        'age' => 24,
        'gender' => 'male',
    123,
    456,
);

foreach($ar2 as $v) {

    echo "$v <br>";
}

foreach($ar2 as $k=>$v) {

    echo "$k =&gt; $v <br>";
}
