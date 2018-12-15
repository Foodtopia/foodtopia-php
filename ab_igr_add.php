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

$pname = 'igr_add'; // 自訂的頁面名稱

if(!empty($_POST['product_name']) and !empty($_POST['product_id'])){

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

        $sql = "INSERT INTO `igr_test`(
 `main_category`, `sub_category`, `product_name`, `product_id`, `price`, `description`,`spec`,`product_img`
 ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['main_category'],
            $_POST['sub_category'],
            $_POST['product_name'],
            $_POST['product_id'],
            $_POST['price'],
            $_POST['description'],
            $_POST['spec'],
            $_POST['product_img']
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
            'text' => '資料 請勿重複'
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
                        <label for="main_category">主分類</label>
                        <input type="text" class="form-control"
                               id="main_category" name="main_category"
                               placeholder="Enter main_category">
                    </div>
                    <div class="form-group">
                        <label for="sub_category">次分類</label>
                        <input type="text" class="form-control"
                               id="sub_category" name="sub_category" placeholder="Enter sub_category">
                    </div>
                    <div class="form-group">
                        <label for="product_name">產品名稱</label>
                        <input type="text" class="form-control"
                               id="product_name" name="product_name" placeholder="Enter product_name">
                    </div>
                    <div class="form-group">
                        <label for="product_id">產品id</label>
                        <input type="text" class="form-control"
                               id="product_id" name="product_id" placeholder="Enter product_id">
                    </div>
                    <div class="form-group">
                        <label for="price">價格</label>
                        <input type="text" class="form-control"
                               id="price" name="price" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="description">產品說明</label>
                        <input type="text" class="form-control"
                               id="description" name="description" placeholder="Enter description">
                    </div>
                    <div class="form-group">
                        <label for="spec">規格</label>
                        <input type="text" class="form-control"
                               id="spec" name="spec" placeholder="Enter spec">
                    </div>
                    <div class="form-group">
                        <label for="product_img">圖檔名稱</label>
                        <input type="text" class="form-control"
                               id="product_img" name="product_img" placeholder="Enter product_img">
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