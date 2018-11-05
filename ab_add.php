<?php
require __DIR__. '/__connect_db.php';

$pname = 'add'; // 自訂的頁面名稱

//
//$per_page = 5; //每頁有幾筆
//$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // 第幾頁
//
//$t_sql = "SELECT COUNT(1) FROM address_book";
//$total_rows = $pdo->query($t_sql)->fetch()[0]; //總筆數
//$total_pages = ceil($total_rows/$per_page); //總頁數
//
//$sql = sprintf("SELECT * FROM address_book LIMIT %s, %s",
//    ($page-1)*$per_page, $per_page);
//$stmt = $pdo->query($sql);
?>
<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>
<div class="container" style="margin-top: 20px">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">新增資料</h5>
                <form method="post">
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control"
                               id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">電郵</label>
                        <input type="email" class="form-control"
                               id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input type="text" class="form-control"
                               id="mobile" name="mobile" placeholder="Enter mobile">
                    </div>
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input type="text" class="form-control"
                               id="birthday" name="birthday" placeholder="Enter birthday">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control"
                               id="address" name="address" placeholder="Enter address">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include __DIR__. '/__html_foot.php';