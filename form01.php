<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_POST['email'])):
    print_r($_POST);
else:
?>
<form name="form1" action="" method="post">
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    <br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <br>
    <input type="submit">
</form>
<?php
endif;
?>



</body>
</html>