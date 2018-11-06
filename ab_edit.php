<?php
require __DIR__. '/__connect_db.php';

$pname = 'edit'; // 自訂的頁面名稱

if(!isset($_GET['sid'])){
    header('Location: ab_list.php');
    exit;
}
$sid =  intval($_GET['sid']);

if(!empty($_POST['name']) and !empty($_POST['email'])){
    try {
        $sql = "UPDATE `address_book` SET 
`name`=?,
`email`=?,
`mobile`=?,
`address`=?,
`birthday`=?
WHERE `sid`=?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['mobile'],
            $_POST['address'],
            $_POST['birthday'],
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

$r_sql = "SELECT * FROM address_book WHERE sid=$sid";
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
                        <label for="name">姓名</label>
                        <input type="text" class="form-control"
                               id="name" name="name" value="<?= htmlentities($r_row['name']) ?>"
                               placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">電郵</label>
                        <input type="email" class="form-control" readonly
                               id="email" name="email" value="<?= htmlentities($r_row['email']) ?>"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input type="text" class="form-control"
                               id="mobile" name="mobile" value="<?= htmlentities($r_row['mobile']) ?>"
                               placeholder="Enter mobile">
                    </div>
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input type="text" class="form-control"
                               id="birthday" name="birthday" value="<?= htmlentities($r_row['birthday']) ?>"
                               placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control"
                               id="address" name="address" value="<?= htmlentities($r_row['address']) ?>"
                               placeholder="Enter address">
                    </div>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
        var name = $('#name'),
            email = $('#email'),
            i;

        function formCheck(){
            var birthday_pattern = /\d{4}\-\d{1,2}\-\d{1,2}/;
            var isPass = true;

            if(! name.val()){
                alert('請填寫姓名');
                isPass = false;
            }
            if(! email.val()){
                alert('請填寫電子郵箱');
                isPass = false;
            }
            return isPass;
        }

    </script>
<?php include __DIR__. '/__html_foot.php';