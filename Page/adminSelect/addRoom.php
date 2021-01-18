<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();


$sql = "insert into RMS.room values ('$_POST[Rno]', '$_POST[Bno]', '$_POST[Rcapacity]', '$_POST[Rfloor]')";
$result = $conn->query($sql);
