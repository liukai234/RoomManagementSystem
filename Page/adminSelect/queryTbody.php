<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

include_once "queryFunctionSet.php";
creatTbodyFunction('');

function queryWithoutBtn($sql) {
    global $conn;
    $result = $conn->query($sql);
    $columns = $result->field_count;

    while ($row = $result->fetch_array()) {
        echo("<tr>");
        for ($i = 0; $i < $columns; $i++) {
            echo("<th>{$row[$i]}</th>");
        }
        echo("</tr>");
    }
}

function queryWithBtn($sql, $alterBtnClass, $delBtnClass) {
    global $conn;
    $result = $conn->query($sql);
    if(!$result) {
        die("<h3>ERROR</h3>");
    }
    $columns = $result->field_count;

    $head_array = array();
    for ($i = 0; $head = $result->fetch_field(); $i++) {
        $head_array[$i] = $head->name;
    }

    while ($row = $result->fetch_array()) {
        echo("<tr>");
        for ($i = 0; $i < $columns; $i++) {
            // 1. js 获取属性时使用classList[0] classList[1]来获取class中的属性
            // 2. 提供表头Thead 生成信息
            echo("<th class={$head_array[$i]} style='padding-top: 15px'>{$row[$i]}</th>");
            if ($i == $columns - 1) {
                echo("<th>");
                    // <!-- btn js find replace virtual form -->
                    echo("<div class='alter-btn-group'>");
                        echo("<button class='btn btn-default $alterBtnClass'>修改</button>");
                        if($delBtnClass == "delStuInfo") {
                            echo("<button class='btn btn-danger $delBtnClass'>双击删除</button>");
                        } else {
                            // 宿舍暂不允许删除
                            echo("<button class='btn btn-danger $delBtnClass disabled'>双击删除</button>");
                        }
                    echo("</div>");
                echo("</th>");
            }
        }
        echo("</tr>");
    }
}