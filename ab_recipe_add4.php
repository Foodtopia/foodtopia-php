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

$pname = 'ab_recipe_add.php'; // 自訂的頁面名稱
if(!empty($_POST['step_1']) and !empty($_POST['step_2'])){
    try {
        $sql5 = "INSERT INTO `step`(`step_1`,`step_2`,`step_3`,`step_4`,`step_5`,`step_6`) VALUES (?,?,?,?,?,?)";
        $stmt5 = $pdo->prepare($sql5);
        $stmt5->execute([$_POST['step_1'],$_POST['step_2'],$_POST['step_3'],$_POST['step_4'],$_POST['step_5'],$_POST['step_6']]);

        $result = $stmt5->rowCount();
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
                        <label for="step_1">步驟1</label>
                        <input type="text" class="form-control" id="step_1" name="step_1" placeholder="Enter step_1">
                    </div>
                    <div class="form-group">
                        <label for="step_2">步驟2</label>
                        <input type="text" class="form-control" id="step_2" name="step_2" placeholder="Enter step_2">
                    </div>
                    <div class="form-group">
                        <label for="step_3">步驟3</label>
                        <input type="text" class="form-control" id="step_3" name="step_3" placeholder="Enter step_3">
                    </div>
                    <div class="form-group">
                        <label for="step_4">步驟4</label>
                        <input type="text" class="form-control" id="step_4" name="step_4" placeholder="Enter step_4">
                    </div>
                    <div class="form-group">
                        <label for="step_5">步驟5</label>
                        <input type="text" class="form-control" id="step_5" name="step_5" placeholder="Enter step_5">
                    </div>
                    <div class="form-group">
                        <label for="step_6">步驟6</label>
                        <input type="text" class="form-control" id="step_6" name="step_6" placeholder="Enter step_6">
                    </div>
                    <div class="form-group">
                        <label for="step_7">步驟7</label>
                        <input type="text" class="form-control" id="step_7" name="step_7" placeholder="Enter step_7">
                    </div>
                    <div class="form-group">
                        <label for="step_8">步驟8</label>
                        <input type="text" class="form-control" id="step_8" name="step_8" placeholder="Enter step_8">
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

