<?php
include_once "../../headFile.php";
checkAdminLogin();
$conn=getConn();

// 不允许修改的信息这里不准许写入
$sql = "update 
            admin
        set 
            Apasswd = '$_POST[Apasswd]', Aname = '$_POST[Aname]', 
            Asex = '$_POST[Asex]', Atel = $_POST[Atel]
        where Ano = '$_POST[Ano]'";
$result = $conn->query($sql);
$conn->close();

// TODO bug 被JavaScript包围无法跳转
if ($result) {
//    header("location: ../student.php");
} else {
    // error=3 修改失败
//    header("location: ../student.php?error=3");
    exit;
}
