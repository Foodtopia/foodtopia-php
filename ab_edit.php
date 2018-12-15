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

$pname = 'edit'; // 自訂的頁面名稱

if(!isset($_GET['sid'])){
    header('Location: ab_list.php');
    exit;
}
$sid =  intval($_GET['sid']);

if(!empty($_POST['nick_name']) and !empty($_POST['email'])){
    try {
        $sql = "UPDATE `members` SET 
`name`=?,
`email`=?,
`password`=?,
`mobile`=?,
`address`=?,
`account`=?,
`nick_name`=?
WHERE `sid`=?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['mobile'],
            $_POST['address'],
            $_POST['account'],
            $_POST['nick_name'],
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

$r_sql = "SELECT * FROM members WHERE sid=$sid";
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
    <div class="container" style="margin-top: 20px">
    <div class="col-md-6" style='margin:auto'>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style='text-align:center'>會員資料編輯</h5>
                <form method="post" >
                    <div class="form-group">
                        <label for="birthday">帳號啟用("1"為啟用)</label>
                        <input value="<?= htmlentities($r_row['account']) ?>" type="text" class="form-control"
                               id="birthday" name="account" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input value="<?= htmlentities($r_row['name']) ?>" type="text" class="form-control"
                               id="name" name="name" placeholder="Enter here"
                               >
                    </div>
                    <div class="form-group">
                        <label for="name">暱稱</label>
                        <input value="<?= htmlentities($r_row['nick_name']) ?>" type="text" class="form-control"
                               id="name" name="nick_name"
                               placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="email">信箱</label>
                        <input value="<?= htmlentities($r_row['email']) ?>" type="email" class="form-control"
                               id="email" name="email" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="email">密碼</label>
                        <input value="<?= htmlentities($r_row['password']) ?>" type="text" class="form-control"
                               id="email" name="password" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input value="<?= htmlentities($r_row['mobile']) ?>" type="text" class="form-control"
                               id="mobile" name="mobile" placeholder="Enter here">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input value="<?= htmlentities($r_row['address']) ?>" type="text" class="form-control"
                               id="address" name="address" placeholder="Enter here">
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
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