<?php
require __DIR__. '/__connect_db.php';

$pname = 'add'; // 自訂的頁面名稱

if(!empty($_POST['name']) and !empty($_POST['email'])){

//    $sql = sprintf("INSERT INTO `address_book`(
// `name`, `email`, `mobile`, `address`, `birthday`, `created_at`
// ) VALUES (%s, %s, %s, %s, %s, NOW())",
//        $pdo->quote($_POST['name']),
//        $pdo->quote($_POST['email']),
//        $pdo->quote($_POST['mobile']),
//        $pdo->quote($_POST['address']),
//        $pdo->quote($_POST['birthday'])
//
//        );
//
//    echo $sql;

    try {

        $sql = "INSERT INTO `address_book`(
 `name`, `email`, `mobile`, `address`, `birthday`, `created_at`
 ) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['mobile'],
            $_POST['address'],
            $_POST['birthday']
        ]);

        $result = $stmt->rowCount();
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

//        if($result) {
//            echo '<script>alert("資料新增完成")</script>';
//        }

    } catch(PDOException $ex){

        // 如果 email 欄設定為唯一鍵, 不可重複輸入相同的 email
        // SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'aaa@bbb.com' for key 'email'
        // Code: 23000
        echo $ex->getMessage();
        //echo '---'. $ex->getCode(). '---';
        $info = [
            'type' => 'danger',
            'text' => 'email 請勿重複'
        ];
    }
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
                <h5 class="card-title">新增資料 <?php isset($result)? var_dump($result) : '' ?></h5>
                <form method="post" >
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control"
                               id="name" name="name"
                               placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">電郵</label>
                        <input type="email" class="form-control"
                               id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input type="text" class="form-control"
                               id="mobile" name="mobile" placeholder="Enter mobile">
                    </div>
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input type="text" class="form-control"
                               id="birthday" name="birthday" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control"
                               id="address" name="address" placeholder="Enter address">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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