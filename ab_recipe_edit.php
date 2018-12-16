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

$pname = 'recipe_edit'; // 自訂的頁面名稱

// if(!isset($_GET['id'])){
//     header('Location: ab_recipe_list.php');
//     exit;
// }
$id =  intval($_GET['id']);

if(!empty($_POST['menu']) and !empty($_POST['Introduction'])){
    try {
        $sql = "UPDATE `menu01` SET 
                `menu`=?,
                `Introduction`=?,
                `menu_img`=?,
                `time`=?,
                `difficult`=?,
                `serving`=?
                WHERE `id`=?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['menu'],
            $_POST['Introduction'],
            $_POST['menu_img'],
            $_POST['time'],
            $_POST['difficult'],
            $_POST['serving'],
            $id
        ]);

        $result = $stmt->rowCount();
        if($result==1){
            $info = [
                'type' => 'success',
                'text' => '資料修改成功'
            ];
        } elseif($result==0) {
            $info = [
                'type' => 'danger',
                'text' => '資料修改失敗'
            ];
        }

    } catch(PDOException $ex){
        echo $ex->getMessage();
        //echo '---'. $ex->getCode(). '---';
//        $info = [
//            'type' => 'danger',
//            'text' => 'email 請勿重複'
//        ];
    }
}

$r_sql = "SELECT * FROM menu01 WHERE id=$id";
$r_row = $pdo->query($r_sql)->fetch(PDO::FETCH_ASSOC);

if(empty($r_row)){
    // 如果沒有該筆資料,就到列表頁
    header('Location: ab_recipe_list.php');
    exit;
}

?>
<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>
<div class="container" style="margin-top: 20px">
    <?php if(isset($info)): ?>
    <div class="col-md-6">
        <div class="alert alert-<?= $info['type'] ?>" role="alert">
            <?= $info['text'] ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">修改食譜</h5>
                <form method="post" >
                <div class="form-group">
                        <label for="menu">食譜名稱</label>
                        <input value="<?= htmlentities($r_row['menu']) ?>" type="text" class="form-control"
                               id="menu" name="menu" placeholder="Enter here"
                               >
                    </div>
                    <div class="form-group">
                        <label for="Introduction">食譜簡介</label>
                        <textarea  value="<?= htmlentities($r_row['Introduction']) ?>" type="text" class="form-control"
                               id="Introduction" name="Introduction"
                               placeholder="Enter here"> <?= htmlentities($r_row['Introduction']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="menu_img">食譜圖片</label>
                        <input value="<?= htmlentities($r_row['menu_img']) ?>" type="text" class="form-control"
                               id="menu_img" name="menu_img" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="time">時間</label>
                        <input value="<?= htmlentities($r_row['time']) ?>" type="text" class="form-control"
                               id="time" name="time" placeholder="Enter here">
                    </div>
                    <!-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="time">時間</label>
                        </div>
                        <select class="custom-select" id="time" name="time" >
                            <option selected value="<?= htmlentities($r_row['time']) ?>"><?= htmlentities($r_row['time']) ?></option>
                            <option value="1">15分鐘</option>
                            <option value="2">30分鐘</option>
                            <option value="3">45分鐘</option>
                            <option value="4">60分鐘</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label for="difficult">難度</label>
                        <input value="<?= htmlentities($r_row['difficult']) ?>" type="text" class="form-control"
                               id="difficult" name="difficult" placeholder="Enter here">
                    </div>
                    <!-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="difficult">難度</label>
                        </div>
                        <select class="custom-select" id="difficult" name="difficult" >
                            <option selected value="<?= htmlentities($r_row['difficult_id']) ?>"><?= htmlentities($r_row['difficult']) ?></option>
                            <option value="1">簡單</option>
                            <option value="2">中等</option>
                            <option value="3">困難</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label for="serving">份量</label>
                        <input value="<?= htmlentities($r_row['serving']) ?>" type="text" class="form-control"
                               id="serving" name="serving" placeholder="Enter here">
                    </div>
                    <!-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="serving">份量</label>
                        </div>
                        <select class="custom-select" id="serving" name="serving" >
                            <option selected value="<?= htmlentities($r_row['serving_id']) ?>"><?= htmlentities($r_row['serving']) ?></option>
                            <option value="1">1人份</option>
                            <option value="2">2人份</option>
                            <option value="3">3人份</option>
                            <option value="4">4人份</option>
                        </select>
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="step_1">步驟1</label>
                        <input value="<?= htmlentities($r_row['step_1']) ?>" type="text" class="form-control"
                               id="step_1" name="step_1" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="step_2">步驟2</label>
                        <input value="<?= htmlentities($r_row['step_2']) ?>" type="text" class="form-control"
                               id="step_2" name="step_2" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="step_3">步驟3</label>
                        <input value="<?= htmlentities($r_row['step_3']) ?>" type="text" class="form-control"
                               id="step_3" name="step_3" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="step_4">步驟4</label>
                        <input value="<?= htmlentities($r_row['step_4']) ?>" type="text" class="form-control"
                               id="step_4" name="step_4" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="step_5">步驟5</label>
                        <input value="<?= htmlentities($r_row['step_5']) ?>" type="text" class="form-control"
                               id="step_5" name="step_5" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="step_6">步驟6</label>
                        <input value="<?= htmlentities($r_row['step_6']) ?>" type="text" class="form-control"
                               id="step_6" name="step_6" placeholder="Enter here">
                    </div> -->


                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
        var menu = $('#menu'),
            Introduction = $('#Introduction'),
            i;

        function formCheck(){
            var isPass = true;

            if(! menu.val()){
                alert('請填寫食譜名稱');
                isPass = false;
            }
            if(! Introduction.val()){
                alert('請填寫食譜簡介');
                isPass = false;
            }
            return isPass;
        }

    </script>
<?php include __DIR__. '/__html_foot.php';