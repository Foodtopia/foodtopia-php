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

$pname = 'add'; // 自訂的頁面名稱

if(!empty($_POST['nick_name']) and !empty($_POST['email'])){

//    $sql = sprintf("INSERT INTO `members`(
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

        $sql = "INSERT INTO `members`(
 `name`, `email`, `password`, `mobile`, `address`, `account`, `nick_name`
 ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['mobile'],
            $_POST['address'],
            $_POST['account'],
            $_POST['nick_name']
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
    <div class="col-md-6" style='margin:auto'>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style='text-align:center'>會員資料新增</h5>
                <form method="post" >
                    <div class="form-group">
                        <label for="birthday">帳號啟用("1"為啟用)</label>
                        <input type="text" class="form-control"
                               id="birthday" name="account" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control"
                               id="name" name="name"
                               placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="name">暱稱</label>
                        <input type="text" class="form-control"
                               id="name" name="nick_name"
                               placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="email">信箱</label>
                        <input type="email" class="form-control"
                               id="email" name="email" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="email">密碼</label>
                        <input type="text" class="form-control"
                               id="password" name="password" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input type="text" class="form-control"
                               id="mobile" name="mobile" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control"
                               id="address" name="address" placeholder="Enter here">
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
         var form_els = document.forms[0];
         var el, i;

         // 用迴圈取得表單裡的每一個元素
         // for(i=0; i<form_els.length; i++){
         //     el = $(form_els[i]);
         //     console.log(i, el);
         //     console.log(el.attr('name'), el.val());
         // }

         for(i=0; i<form_els.length; i++){
             el = form_els[i];
             console.log(i, el);
             console.log(el.name, el.value);
         }




    </script>
<?php include __DIR__. '/__html_foot.php';