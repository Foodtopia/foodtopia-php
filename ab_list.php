<?php
require __DIR__. '/__connect_db.php';
$pname = 'list'; // 自訂的頁面名稱

$per_page = 5; //每頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // 第幾頁

$t_sql = "SELECT COUNT(1) FROM address_book";
$total_rows = $pdo->query($t_sql)->fetch()[0]; //總筆數
$total_pages = ceil($total_rows/$per_page); //總頁數

$sql = sprintf("SELECT * FROM address_book LIMIT %s, %s",
    ($page-1)*$per_page, $per_page);
$stmt = $pdo->query($sql);
?>
<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>
<div class="container" style="margin-top: 20px">

    <nav aria-label="Page navigation example">
        <ul class="pagination">
<!--            <li class="page-item"><a class="page-link" href="#">Previous</a></li>-->
            <?php for($i=1; $i<=$total_pages; $i++):?>
            <li class="page-item <?= $i==$page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
            </li>
            <?php endfor ?>

<!--            <li class="page-item"><a class="page-link" href="#">Next</a></li>-->
        </ul>
    </nav>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">mobile</th>
            <th scope="col">address</th>
            <th scope="col">birthday</th>
        </tr>
        </thead>
        <tbody>
        <?php while($r = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <th scope="row"><?= $r['sid'] ?></th>
            <td><?= $r['name'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['mobile'] ?></td>
            <td><?= $r['address'] ?></td>
            <td><?= $r['birthday'] ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__. '/__html_foot.php';