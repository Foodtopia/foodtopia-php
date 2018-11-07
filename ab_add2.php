<?php
//require __DIR__. '/__connect_db.php';

$pname = 'add2'; // 自訂的頁面名稱
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">新增資料2</h5>
                <form method="post" onsubmit="return formCheck()">
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control"
                               id="name" name="name"
                               placeholder="Enter name">
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
                               id="birthday" name="birthday" placeholder="YYYY-MM-DD">
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
    <script>
        var name = $('#name'),
            email = $('#email'),
            i;

        function formCheck(){
            var birthday_pattern = /\d{4}\-\d{1,2}\-\d{1,2}/;
            var isPass = true;
/*
            if(! name.val()){
                alert('請填寫姓名');
                isPass = false;
            }
            if(! email.val()){
                alert('請填寫電子郵箱');
                isPass = false;
            }
*/
            //new FormData

            if(isPass){
                fetch('ab_add_api.php',{
                    method: "POST",
                    mode: "cors",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: $(document.forms[0]).serialize()
                }).then(function(resp){
                    return resp.text();
                }).then(function(txt){
                    console.log(txt); // 檢查回傳字串

                    let json = JSON.parse(txt);

                }).catch(function(ex){
                    console.log('錯誤: ',ex);
                });
            }
            return false;
        }

    </script>
<?php include __DIR__. '/__html_foot.php';