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
require __DIR__ . '/__connect_db.php';
$pname = 'igr_list'; // 自訂的頁面名稱

$per_page = 5; //每頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // 第幾頁

$t_sql = "SELECT COUNT(1) FROM igr_test";
$total_rows = $pdo->query($t_sql)->fetch()[0]; //總筆數
$total_pages = ceil($total_rows / $per_page); //總頁數

// 限定頁碼範圍
if ($page < 1) {
    header('Location: ab_igr_list.php');
    exit;
}
if ($page > $total_pages) {
    header('Location: ab_igr_list.php?page=' . $total_pages);
    exit;
}

$sql = sprintf("SELECT * FROM igr_test ORDER BY sid DESC LIMIT %s, %s",
    ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);
?>
<?php include __DIR__ . '/__html_head.php';?>
<?php include __DIR__ . '/__navbar.php';?>
<div class="container" style="margin-top: 20px">

    <nav aria-label="Page navigation example">
        <ul class="pagination">
<!--            <li class="page-item"><a class="page-link" href="#">Previous</a></li>-->
            <!-- <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?=$i == $page ? 'active' : '';?>">
                <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
            </li>
            <?php endfor?> -->

<!--            <li class="page-item"><a class="page-link" href="#">Next</a></li>-->
        </ul>
    </nav>

    <table class="table">
        <thead class=''>
        <tr>
            <th scope="col">刪除</th>
            <th scope="col">sid</th>
            <th scope="col">主分類</th>
            <th scope="col">次分類</th>
            <th scope="col">產品名稱</th>
            <th scope="col">產品id</th>
            <th scope="col">價格</th>
            <th scope="col">產品說明</th>
            <th scope="col">產品規格</th>
            <th scope="col">圖檔名稱</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($r = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><a href="javascript:del_it(<?=$r['sid']?>)"><i class="fas fa-trash-alt"></i></a></td>
            <th scope="row"><?=$r['sid']?></th>
            <td><?=$r['main_category']?></td>
            <td><?=$r['sub_category']?></td>
            <td><?=$r['product_name']?></td>
            <td><?=$r['product_id']?></td>
            <td><?=$r['price']?></td>
            <td><?=$r['description']?></td>
            <td><?=$r['spec']?></td>
            <td><?=$r['product_img']?></td>
            <td><a href="ab_igr_edit.php?sid=<?=$r['sid']?>"><i class="fas fa-edit"></i></a></td>
        </tr>
        <?php endwhile;?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?=$page == 1 ? 'disabled' : '';?>"><a class="page-link" href="?page=1">&lt;&lt;</a></li>
            <li class="page-item <?=$page == 1 ? 'disabled' : '';?>"><a class="page-link" href="?page=<?=$page - 1?>">&lt;</a></li>
            <li class="page-item"><a class="page-link"><?=$page . '/' . $total_pages?></a></li>
            <li class="page-item <?=$page == $total_pages ? 'disabled' : '';?>"><a class="page-link" href="?page=<?=$page + 1?>">&gt;</a></li>
            <li class="page-item <?=$page == $total_pages ? 'disabled' : '';?>"><a class="page-link" href="?page=<?=$total_pages?>">&gt;&gt;</a></li>
        </ul>
    </nav>
</div>
    <style>
        .page-item {
            color: #FF4343 !important;
        }
        .page-item a {
            color: #FF4343 !important;
        }
        .page-item.active .page-link {
            background-color: #fff !important;
    border-color: #ccc !important;
        }
        .page-item .page-link {
            background-color: #fff !important;
    /* border-color: #FF4343 !important; */
        }
        i {
            color : #FF4343 !important;
        }
    </style>
    <script>
        function del_it(sid){
            if(confirm('你確定要刪除編號為 '+sid+' 的資料嗎?')){
                location.href = 'ab_del.php?sid=' + sid;
            }
        }

    </script>
<?php include __DIR__ . '/__html_foot.php';