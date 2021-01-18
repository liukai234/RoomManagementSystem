<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin As Admin</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<body>
<?php
include_once "headFile.php";
errorInfo();
?>

<div class="container">
    <form action="checkSigninAsAdmin.php" class="form-signin" method="post">
        <h2 class="form-signin-heading">宿管登录</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="Aaccount" id="inputEmail" class="form-control" placeholder="工号" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="Apasswd" id="inputPassword" class="form-control" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    </form>

</div>
</body>
</html>
