<?php

$target_dir = __DIR__. '/uploads/';

if(isset($_FILES['my_file'])) {
    echo $_FILES['my_file']['tmp_name'] . '<br>';
    echo $_FILES['my_file']['name'] . '<br>';


    if(move_uploaded_file(
        $_FILES['my_file']['tmp_name'],
        $target_dir. $_FILES['my_file']['name']
    )){
        echo 'The file saved!';
    }

}
