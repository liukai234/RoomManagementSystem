<?php
include_once "headFile.php";
$conn = getConn();


$account = $_POST['Saccount'];
$passwd = $_POST['Spasswd'];


$sql = "select Sno, Spasswd from RMS.student where Sno = $account and Spasswd = $passwd";
$result = $conn->query($sql);
$conn->close();


if ($result->num_rows <= 0) {
    // error = 1 账号或密码错误
    header("location: signinAsStu.php?error=1");
    exit;
} else {
    $_SESSION['Saccount'] = $account;
    $_SESSION['Spasswd'] = $passwd;

    // 设置登录状态
    $_SESSION['SHasLogin'] = true;
    header("location: student.php");
}
