<?php
include_once "headFile.php";
$conn = getConn();


$account = $_POST['Aaccount'];
$passwd = $_POST['Apasswd'];


$sql = "select Ano, Apasswd from RMS.admin where Ano = $account and Apasswd= $passwd";
$result = $conn->query($sql);
$conn->close();


if ($result->num_rows <= 0) {
    header("location: signinAsAdmin.php?error=1");
    exit;

} else {
    $_SESSION['Aaccount'] = $account;
    $_SESSION['Apasswd'] = $passwd;

    $_SESSION['AHasLogin'] = true;
    header("location: manager.php");
}
