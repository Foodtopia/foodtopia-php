<?php
require __DIR__. '/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM igr_test");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>
<div class="container" style="margin-top: 20px">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">main_category</th>
            <th scope="col">sub_category</th>
            <th scope="col">product_name</th>
            <th scope="col">product_id</th>
            <th scope="col">price</th>
            <th scope="col">description</th>
            <th scope="col">spec</th>
            <th scope="col">product_img</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $r): ?>
        <tr>
            <th scope="row"><?= $r['sid'] ?></th>
            <td><?= $r['main_category'] ?></td>
            <td><?= $r['sub_category'] ?></td>
            <td><?= $r['product_name'] ?></td>
            <td><?= $r['product_id'] ?></td>
            <td><?= $r['price'] ?></td>
            <td><?= $r['description'] ?></td>
            <td><?= $r['spec'] ?></td>
            <td><?= $r['product_img'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__. '/__html_foot.php';