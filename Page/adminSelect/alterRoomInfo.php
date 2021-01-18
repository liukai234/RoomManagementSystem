<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

// should be call _POST['xxx'] is null
// if it is null return error info by _GET['xxx']
// for example header location
$sql = "update RMS.room set Rno = '$_POST[Rno]', Bno = '$_POST[Bno]', Rcapacity = '$_POST[Rcapacity]', Rfloor = '$_POST[Rfloor]' where Rno = '$_POST[Rno]' and Bno = '$_POST[Bno]'";

$result = $conn->query($sql);
$conn->close();

//header("location: student.php");
//if ($result != true) {
////    TODO 违规操作提示
////    header("location: student.php");
////    exit;
//} else {
//    header("location: student.php");
//}
