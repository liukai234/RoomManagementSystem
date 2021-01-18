<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "update student set Sin = 1, SleftTime = '2020/1/1' where Sno = $_POST[Sno]";

$result = $conn->query($sql);
//$result->num_rows; // Debug