<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Information Page</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/manage.css" rel="stylesheet">
    <link href="css/profileSettings.css" rel="stylesheet">
</head>

<body>
<?php
include_once "headFile.php";
checkStuLogin();
errorInfo();
$conn = getConn();
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="student.php">Student Page</a>
            <a class="navbar-brand" href="logout.php">退出</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li id="student_button" class="active"><a href="#">个人信息</a></li>
                <li id="admin_button"><a href="#">宿管信息</a></li>
            </ul>
        </div>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="stu-info"></div>
            <div class="admin-info"></div>
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/student.js"></script>
</body>
</html>
