<?php
require __DIR__. '/__connect_db.php';

$result = [
    'success' => false, //資料修改是否成功
    'resultCode' => 400, //狀態碼
    'errorMsg' => '沒有 post 資料', //錯誤訊息
    'postData' => [],
];

if(!isset($_GET['id'])){
    $result['resultCode'] = 401;
    $result['errorMsg'] = '沒有 id';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$id =  intval($_GET['id']);

if(!empty($_POST['menu']) and !empty($_POST['Introduction'])){
    $result['postData'] = $_POST;
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

        $r = $stmt->rowCount();
        $result['rowCount'] = $r;
        if($r==1){
            $result['success'] = true;
            $result['resultCode'] = 200;
            $result['errorMsg'] = '';
        } elseif($result==0) {
            $result['resultCode'] = 403;
            $result['errorMsg'] = '資料沒有修改';
        }

    } catch(PDOException $ex){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $ex->getMessage();

    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
