<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select Bno, Ano from RMS.build_admin";
$result = $conn->query($sql);
$columns = $result->field_count; // 列的数量

// 循环从$result_build中取出行
while ($row = $result->fetch_array()) {
    echo("<tr>");
    for ($i = 0; $i < $columns; $i++) {
        // 构造post信息，提交时通过js将post传递给load_form.php,请求表单
        // if ($i == 0) echo("<form id='form_for_alter_btn'><input class='hidden' type='text' name='{$post}' value='{$row_build[$i]}'></form>");
        echo("<th>{$row[$i]}</th>");
        // if ($i == $columns_build - 1) echo("<td><button class=\"btn btn-default\" id=\"alterInfo\">修改</button></td>");
    }
    echo("</tr>");
}
?>