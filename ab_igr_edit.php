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

$pname = 'igr_edit'; // 自訂的頁面名稱

if(!isset($_GET['sid'])){
    header('Location: ab_list.php');
    exit;
}
$sid =  intval($_GET['sid']);

if(!empty($_POST['product_name']) and !empty($_POST['product_id'])){
    try {
        $sql = "UPDATE `igr_test` SET 
`main_category`=?,
`sub_category`=?,
`product_name`=?,
`product_id`=?,
`price`=?,
`description`=?,
`spec`=?,
`product_img`=?
WHERE `sid`=?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['main_category'],
            $_POST['sub_category'],
            $_POST['product_name'],
            $_POST['product_id'],
            $_POST['price'],
            $_POST['description'],
            $_POST['spec'],
            $_POST['product_img'],
            $sid
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

$r_sql = "SELECT * FROM igr_test WHERE sid=$sid";
$r_row = $pdo->query($r_sql)->fetch(PDO::FETCH_ASSOC);

if(empty($r_row)){
    // 如果沒有該筆資料,就到列表頁
    header('Location: ab_list.php');
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
                <h5 class="card-title">修改資料</h5>
                <form method="post" >
                    <div class="form-group">
                        <label for="main_category">主分類</label>
                        <input type="text" class="form-control"
                               id="main_category" name="main_category" value="<?= htmlentities($r_row['main_category']) ?>"
                               placeholder="Enter main_category">
                    </div>
                    <div class="form-group">
                        <label for="sub_category">次分類</label>
                        <input type="text" class="form-control" readonly
                               id="sub_category" name="sub_category" value="<?= htmlentities($r_row['sub_category']) ?>"
                               placeholder="Enter sub_category">
                    </div>
                    <div class="form-group">
                        <label for="product_name">產品名稱</label>
                        <input type="text" class="form-control"
                               id="product_name" name="product_name" value="<?= htmlentities($r_row['product_name']) ?>"
                               placeholder="Enter product_name">
                    </div>
                    <div class="form-group">
                        <label for="product_id">產品id</label>
                        <input type="text" class="form-control"
                               id="product_id" name="product_id" value="<?= htmlentities($r_row['product_id']) ?>"
                               placeholder="Enter product_id">
                    </div>
                    <div class="form-group">
                        <label for="price">價格</label>
                        <input type="text" class="form-control"
                               id="price" name="price" value="<?= htmlentities($r_row['price']) ?>"
                               placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="description">產品說明</label>
                        <input type="text" class="form-control"
                               id="description" name="description" value="<?= htmlentities($r_row['description']) ?>"
                               placeholder="Enter description">
                    </div>
                    <div class="form-group">
                        <label for="spec">產品規格</label>
                        <input type="text" class="form-control"
                               id="spec" name="spec" value="<?= htmlentities($r_row['spec']) ?>"
                               placeholder="Enter spec">
                    </div>
                    <div class="form-group">
                        <label for="product_img">地址</label>
                        <input type="text" class="form-control"
                               id="product_img" name="product_img" value="<?= htmlentities($r_row['product_img']) ?>"
                               placeholder="Enter product_img">
                    </div>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
        var name = $('#product_name'),
            email = $('#product_id'),
            i;

        function formCheck(){
            var birthday_pattern = /\d{4}\-\d{1,2}\-\d{1,2}/;
            var isPass = true;

            if(! name.val()){
                alert('請填寫產品名稱');
                isPass = false;
            }
            if(! email.val()){
                alert('請填寫產品id');
                isPass = false;
            }
            return isPass;
        }

    </script>
<?php include __DIR__. '/__html_foot.php';