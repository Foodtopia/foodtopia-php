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
if(!empty($_POST['menu']) and !empty($_POST['Introduction'])){
    try {
        $sql6 = "INSERT INTO `ingredients`(`ingredients_img`,`ingredients_name`,`ingredients_id`) VALUES (?,?,?)";
        $stmt6 = $pdo->prepare($sql6);
        $stmt6->execute([ $_POST['ingredients_img'],$_POST['ingredients_name'],$_POST['ingredients_id'],]);

        $result = $stmt6->rowCount();
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
                <h5 class="card-title">新增食譜</h5>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="menu_img">食譜照</label>
                        <input type="file" name="menu_img" class="form-control" id="menu_img">
                    </div>
                    <div class="form-group">
                        <label for="menu">食譜名稱</label>
                        <input type="text" class="form-control"
                               id="menu" name="menu"
                               placeholder="Enter menu">
                    </div>
                    <div class="form-group">
                        <label for="Introduction">食譜簡介</label>
                        <input type="Introduction" class="form-control"
                               id="Introduction" name="Introduction" placeholder="Enter Introduction">
                    </div>
                    <div class="form-group">
                        <label for="difficult">食譜難易度</label>
                        <input type="text" class="form-control"
                               id="difficult" name="difficult" placeholder="Enter difficult">
                    </div>
                    <div class="form-group">
                        <label for="time">食譜製作時間</label>
                        <input type="text" class="form-control"
                               id="time" name="time" placeholder="time">
                    </div>
                    <div class="form-group">
                        <label for="serving">食譜分量</label>
                        <input type="text" class="form-control"
                               id="serving" name="serving" placeholder="Enter serving">
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

