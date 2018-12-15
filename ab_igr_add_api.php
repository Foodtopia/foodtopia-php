<?php
require __DIR__. '/__connect_db.php';

$result = [
    'success' => false, //資料取得是否成功
    'resultCode' => 400, //狀態碼
    'errorMsg' => '沒有 post 資料', //錯誤訊息
    'postData' => [],
];

if(!empty($_POST['product_name']) and !empty($_POST['product_id'])){

    $r_sql = "SELECT * FROM igr_test WHERE product_id=?";
    $r_stmt = $pdo->prepare($r_sql);
    $r_stmt->execute([
        $_POST['product_id']
    ]);
    if($r_stmt->rowCount()==1){
        $result['resultCode'] = 408;
        $result['errorMsg'] = '產品id 重複';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $result['postData'] = $_POST;

    try {

        $sql = "INSERT INTO `igr_test`(
 `main_category`, `sub_category`, `product_name`, `product_id`, `price`, `description`,`spec`,`product_img`
 ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
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

        $r = $stmt->rowCount();
        $result['rowCount'] = $r;

        if($r==1){
            $result['success'] = true;
            $result['resultCode'] = 200;
            $result['errorMsg'] = '';

        } elseif($r==0) {
            $result['resultCode'] = 405;
            $result['errorMsg'] = '資料沒有新增';
        }
    } catch(PDOException $ex){
        $result['resultCode'] = 407;
        $result['errorMsg'] = $ex->getMessage();
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
