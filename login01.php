<?php
session_start();

$user = isset($_POST['user']) ? $_POST['user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// 如果還沒有登入
if(! isset($_SESSION['user'])){
    // 判斷是否有送登入的帳號密碼
    if(isset($_POST['user']) and isset($_POST['password'])){
        // 比對帳號和密碼是否正確
        if($_POST['user']==='shin' and $_POST['password']==='1234'){
            $_SESSION['user'] = 'shin'; // 代表已登入
        }
    }
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if(isset($_SESSION['user'])): ?>
Hello <?= $_SESSION['user'] ?>
    <br>
    <a href="logout01.php">登出</a>
<?php else: ?>
<form action="" method="post">
    <label for="user">用戶名稱</label>
    <input type="text" id="user" name="user" value="<?= htmlentities($user) ?>">
    <br>
    <label for="user">密碼</label>
    <input type="password" id="password" name="password" value="<?= htmlentities($password) ?>">
    <br>
    <input type="submit" value="登入">
    <br>
</form>
<?php endif; ?>


</body>
</html>