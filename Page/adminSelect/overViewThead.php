<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select Bno, Ano from RMS.build_admin limit 0";
$result = $conn->query($sql);
$columns = $result->field_count; // 列的数量

// $is_true = true;
while ($head = $result->fetch_field()) {

    // 构造post信息
    // if ($is_true) $post = $head->name;
    // $is_true = false;
    echo("<th>{$head->name}</th>");
}
?>