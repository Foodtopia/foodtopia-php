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

$pname = 'order_edit'; // 自訂的頁面名稱

if(!isset($_GET['sid'])){
    header('Location: ab_order_list.php');
    exit;
}
$sid =  intval($_GET['sid']);

if(!empty($_POST['mobile']) and !empty($_POST['address'])){
    try {
        $sql = "UPDATE `orders` SET 
`name`=?,
`tel`=?,
`mobile`=?,
`zipCode`=?,
`county`=?,
`district`=?,
`address`=?,
`ship`=?,
`ship_date`=?,
`ship_time`=?,
`note`=?,
`pay`=?,
`amount`=?,
`isPay`=?,
`isShip`=?
WHERE `sid`=?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['tel'],
            $_POST['mobile'],
            $_POST['zipCode'],
            $_POST['county'],
            $_POST['district'],
            $_POST['address'],
            $_POST['ship'],
            $_POST['ship_date'],
            $_POST['ship_time'],
            $_POST['note'],
            $_POST['pay'],
            $_POST['amount'],
            $_POST['isPay'],
            $_POST['isShip'],
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

$r_sql = "SELECT * FROM `orders` WHERE sid=$sid";
$r_row = $pdo->query($r_sql)->fetch(PDO::FETCH_ASSOC);

if(empty($r_row)){
    // 如果沒有該筆資料,就到列表頁
    header('Location: ab_order_list.php');
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
    <div class="container" style="margin-top: 20px">
    <div class="col-md-6" style='margin:auto'>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style='text-align:center'>訂單資料編輯</h5>
                <form method="post" >
                    <div class="form-group">
                        <label for="order_num">訂單編號</label>
                        <input value="<?= htmlentities($r_row['order_num']) ?>" type="text" class="form-control"
                               id="order_num" readonly>
                    </div>
                    <div class="form-group">
                        <label for="member_sid">會員編號</label>
                        <input value="<?= htmlentities($r_row['member_sid']) ?>" type="text" class="form-control"
                               id="member_sid" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input value="<?= htmlentities($r_row['name']) ?>" type="text" class="form-control"
                               id="name" name="name" placeholder="Enter here"
                               >
                    </div>
                    <div class="form-group">
                        <label for="tel">市話</label>
                        <input value="<?= htmlentities($r_row['tel']) ?>" type="text" class="form-control"
                               id="tel" name="tel"
                               placeholder="選填">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input value="<?= htmlentities($r_row['mobile']) ?>" type="text" class="form-control"
                               id="mobile" name="mobile" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="">地址</label>
                        <div class='d-flex'>
                        <input value="<?= htmlentities($r_row['zipCode']) ?>" type="text" class="form-control mr-1 text-center"
                               id="zipCode" name="zipCode" placeholder="郵遞區號" style="width:55px">
                        <input value="<?= htmlentities($r_row['county']) ?>" type="text" class="form-control mr-1"
                               id="county" name="county" placeholder="縣市" style="width: 100px">
                        <input value="<?= htmlentities($r_row['district']) ?>" type="text" class="form-control"
                               id="district" name="district" placeholder="鄉/鎮/市/區" style="width:100px">
                        </div>
                        <input value="<?= htmlentities($r_row['address']) ?>" type="text" class="form-control mt-1"
                               id="address" name="address" placeholder="街道地址">
                    </div>
                    <div class="form-group">
                        <label for="ship">寄送方式</label>
                        <select class="form-control" id="ship" name="ship">
                        <option value ="宅配到府" <?=$r_row['ship'] == '宅配到府' ? 'selected' : ''?>>宅配到府</option>
                        <option value ="其他">其他</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ship_date">送達時間</label>
                        <div class='d-flex'>
                        <input value="<?= htmlentities($r_row['ship_date']) ?>" type="text" class="form-control mr-1 text-center"
                               id="ship_date" name="ship_date" placeholder="yyyy-mm-dd" style='width: 120px'>
                        <input value="<?= htmlentities($r_row['ship_time']) ?>" type="text" class="form-control text-center"
                               id="ship_time" name="ship_time" placeholder="hh:mm:ss" style='width: 100px'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">訂單備註</label>
                        <textarea value="<?= htmlentities($r_row['note']) ?>" type="text" class="form-control"
                               id="note" name="note" placeholder="請輸入備註" style="resize: none"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pay">付款方式</label>
                        <select class="form-control" id="pay" name="pay">
                        <option value ="信用卡" <?=$r_row['pay'] == '信用卡' ? 'selected' : ''?>>信用卡</option>
                        <option value ="ATM轉帳" <?=$r_row['pay'] == 'ATM轉帳' ? 'selected' : ''?>>ATM轉帳</option>
                        <option value ="貨到付款" <?=$r_row['pay'] == '貨到付款' ? 'selected' : ''?>>貨到付款</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">付款金額</label>
                        <input value="<?= htmlentities($r_row['amount']) ?>" type="text" class="form-control"
                               id="amount" name="amount" readonly>
                    </div>
                    <div class="form-group">
                        <label for="created_at">訂單時間</label>
                        <input value="<?= htmlentities($r_row['created_at']) ?>" type="text" class="form-control"
                               id="created_at" readonly>
                    </div>
                    <div class="form-group">
                        <label for="isShip">出貨狀態</label>
                        <select class="form-control" id="isShip" name="isShip">
                        <option value =0 <?=$r_row['isShip'] == 0 ? 'selected' : ''?>>未出貨</option>
                        <option value =1 <?=$r_row['isShip'] == 1 ? 'selected' : ''?>>已出貨</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isPay">付款狀態</label>
                        <select class="form-control" id="isPay" name="isPay">
                        <option value =0 <?=$r_row['isPay'] == 0 ? 'selected' : ''?>>未付款</option>
                        <option value =1 <?=$r_row['isPay'] == 1 ? 'selected' : ''?>>已付款</option>
                        </select>
                    </div>
                    <button id='submit' type="submit" class="btn btn-danger w-100">修改</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
    var submit = document.querySelector('#submit')
        submit.addEventListener('click',function(){
        console.log()
        })

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