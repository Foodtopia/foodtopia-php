<?php
session_start();
if ($_SESSION['user'] == 'login' || ($_POST['email'] == 'foodtopia@gmail.com' and $_POST['password'] == '123')) {
    $_SESSION['user'] = 'login';     // 代表已登入
} else {
    header("Location: http://localhost:3001/login"); 
    exit;
}
?>
<?php

require __DIR__. '/__connect_db.php';

$pname = 'ab_recipe_add2.php'; // 自訂的頁面名稱
if(!empty($_POST['name_1']) and !empty($_POST['name_2'])){
    try {
        // $sql2 = "SELECT `id` FROM `menu01` ORDER BY `id` DESC LIMIT 1";
        $sql3 = "INSERT INTO `ingredients_name`(`name_1`,`name_2`,`name_3`,`name_4`,`name_5`,`name_6`) VALUES (?,?,?,?,?,?)";
        // $stmt2 = $pdo->prepare($sql2);
        $stmt3 = $pdo->prepare($sql3);
        // $stmt2->$pdo->query($t_sql)->fetch();
        $stmt3->execute([$_POST['name_1'],$_POST['name_2'],$_POST['name_3'],$_POST['name_4'],$_POST['name_5'],$_POST['name_6'],]);

        $result = $stmt3->rowCount();
            if($result==1){
            $info = [
                'type' => 'success',
                'text' => '資料新增完成'
            ];
            } elseif($result==0) {
            $info = [
                'type' => 'danger',
                'text' => '資料沒有新增'
            ];
        }
    } catch(PDOException $ex){
        echo $ex->getMessage();
        $info = [
            'type' => 'danger',
            'text' => '資料 請勿重複'
        ];
    }
}    
?>

<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>

<div class="recipe container" style="width:100vw;margin-top: 20px">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name_1">食材1</label>
                        <input type="text" class="form-control" id="name_1" name="name_1" placeholder="Enter name_1">
                    </div>
                    <div class="form-group">
                        <label for="name_2">食材2</label>
                        <input type="text" class="form-control" id="name_2" name="name_2" placeholder="Enter name_2">
                    </div>
                    <div class="form-group">
                        <label for="name_3">食材3</label>
                        <input type="text" class="form-control" id="name_3" name="name_3" placeholder="Enter name_3">
                    </div>
                    <div class="form-group">
                        <label for="name_4">食材4</label>
                        <input type="text" class="form-control" id="name_4" name="name_4" placeholder="Enter name_4">
                    </div>
                    <div class="form-group">
                        <label for="name_5">食材5</label>
                        <input type="text" class="form-control" id="name_5" name="name_5" placeholder="Enter name_5">
                    </div>
                    <div class="form-group">
                        <label for="name_6">食材6</label>
                        <input type="text" class="form-control" id="name_6" name="name_6" placeholder="Enter name_6">
                    </div>
                    <div class="form-group">
                        <label for="name_7">食材7</label>
                        <input type="text" class="form-control" id="name_7" name="name_7" placeholder="Enter name_7">
                    </div>
                    <div class="form-group">
                        <label for="name_8">食材8</label>
                        <input type="text" class="form-control" id="name_8" name="name_8" placeholder="Enter name_8">
                    </div>
                    <button type="submit" class="btn btn-danger mt-4"  style="width:5vw;margin-left:42%">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var form_els = document.forms[0];
    var el, i;

    for(i=0; i<form_els.length; i++){
        el = form_els[i];
        console.log(i, el);
        console.log(el.name, el.value);
    }
</script>

<?php include __DIR__. '/__html_foot.php';

