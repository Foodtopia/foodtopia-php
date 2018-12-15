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

if(!isset($_GET['id'])){
    header('Location: ab_recipe_list.php');
    exit;
    //die('Hello');
}
$id =  intval($_GET['id']);

$sql = "DELETE FROM `menu01` WHERE id=$id";

$stmt = $pdo->query($sql);

//echo $stmt->rowCount();
if(isset($_SERVER['HTTP_REFERER'])){
    // 從哪裡來, 從哪裡回去
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ab_recipe_list.php'); // 回到列表頁的第一頁
}



