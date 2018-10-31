<pre>
<?php
$ar = array(
    "num" => 17,
    'name' => 'shinder',
);
$br = $ar; // 複製一份新的
$cr = &$ar; // 設定位址, 兩者是相同的陣列
$ar['num'] = 26;
print_r($ar);
print_r($br);
print_r($cr);
?>
</pre>