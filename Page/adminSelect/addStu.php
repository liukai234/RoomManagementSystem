<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$conn->begin_transaction();

try{
    // Stu信息
    $sqlStu = "insert into student values ('{$_POST['Sno']}', '{$_POST['Spasswd']}', '{$_POST['Sname']}', '{$_POST['Ssex']}', '{$_POST['Sdepartment']}', '{$_POST['SleftTime']}', '{$_POST['Sclass']}', '{$_POST['Stel']}', '{$_POST['Saddress']}', '{$_POST['Sin']}', '{$_POST['Sstay']}')";
    // $sqlStudentRoom信息
    $sqlStuRoom = "insert into student_room values ('{$_POST['Sno']}', '{$_POST['Rno']}', '{$_POST['Bno']}')";

    $result = $conn->query($sqlStu);
    $result = $conn->query($sqlStuRoom);

    // 执行正常则提交，否则回滚 TODO 捕获异常
    $conn->commit();
} catch (mysqli_sql_exception $exception){
    $conn->rollback();
    throw $exception;
}


