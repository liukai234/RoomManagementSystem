<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

include_once "queryFunctionSet.php";
// 只查询表头
creatTbodyFunction('limit 0');

function queryWithoutBtn($sql) {
    global $conn;
    $result = $conn->query($sql);

    while ($head = $result->fetch_field()) {
        echo("<th>{$head->name}</th>");
    }
}

function queryWithBtn($sql, $alterBtnClass, $delBtnClass) {
    global $conn;
    $result = $conn->query($sql);
    if(!$result) {
        die("<h3>ERROR</h3>");
    }

    // 提取表头 head_array
    $head_array = array();
    for ($i = 0; $head = $result->fetch_field(); $i++) {
        $head_array[$i] = $head->name;
    }

    for ($i = 0; $i < count($head_array); $i ++) {
        echo("<th>{$head_array[$i]}</th>");
        if($i == count($head_array) - 1) {
            echo("<th>选项</th>");
        }
    }
}