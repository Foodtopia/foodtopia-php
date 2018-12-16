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
//上傳圖片
$target_dir = __DIR__. '/uploads/';

if(isset($_FILES['menu_img'])) {
    // echo $_FILES['my_file']['tmp_name'] . '<br>';
    // echo $_FILES['my_file']['name'] . '<br>';
    if(move_uploaded_file(
        $_FILES['menu_img']['tmp_name'],
        $target_dir.$_FILES['menu_img']['name']
    )){
        echo '圖片已上傳';
    }
}

require __DIR__. '/__connect_db.php';

$pname = 'ab_recipe_add3.php'; // 自訂的頁面名稱
if(!empty($_POST['step_img_1']) and !empty($_POST['step_img_2'])){
    try {
        $sql4 = "INSERT INTO `step_img`(`step_img_1`,`step_img_2`,`step_img_3`,`step_img_4`,`step_img_5`,`step_img_6`) VALUES (?,?,?,?,?,?)";
        $stmt4 = $pdo->prepare($sql4);
        $step_img_1 = $target_dir.$_FILES['step_img_1']['name'];
        $step_img_2 = $target_dir.$_FILES['step_img_2']['name'];
        $step_img_3 = $target_dir.$_FILES['step_img_3']['name'];
        $step_img_4 = $target_dir.$_FILES['step_img_4']['name'];
        $step_img_5 = $target_dir.$_FILES['step_img_5']['name'];
        $step_img_6 = $target_dir.$_FILES['step_img_6']['name'];
        $stmt4->execute([$_POST[$step_img_1],$_POST[$step_img_2],$_POST[$step_img_3],$_POST[$step_img_4],$_POST[$step_img_5],$_POST[$step_img_6]]);

        $result = $stmt4->rowCount();
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
                        <label for="step_img_1">步驟圖1</label>
                        <input type="file" class="form-control" id="step_img_1" name="step_img_1">
                    </div>
                    <div class="form-group">
                        <label for="step_img_2">步驟圖2</label>
                        <input type="file" class="form-control" id="step_img_2" name="step_img_2">
                    </div>
                    <div class="form-group">
                        <label for="step_img_3">步驟圖3</label>
                        <input type="file" class="form-control" id="step_img_3" name="step_img_3">
                    </div>
                    <div class="form-group">
                        <label for="step_img_4">步驟圖4</label>
                        <input type="file" class="form-control" id="step_img_4" name="step_img_4">
                    </div>
                    <div class="form-group">
                        <label for="step_img_5">步驟圖5</label>
                        <input type="file" class="form-control" id="step_img_5" name="step_img_5">
                    </div>
                    <div class="form-group">
                        <label for="step_img_6">步驟圖6</label>
                        <input type="file" class="form-control" id="step_img_6" name="step_img_6">
                    </div>
                    <div class="form-group">
                        <label for="step_img_7">步驟圖7</label>
                        <input type="file" class="form-control" id="step_img_7" name="step_img_7">
                    </div>
                    <div class="form-group">
                        <label for="step_img_8">步驟圖8</label>
                        <input type="file" class="form-control" id="step_img_8" name="step_img_8">
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

