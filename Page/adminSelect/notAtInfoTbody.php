<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

// isset($_POST['filterInput']) 如果有定义
if(isset($_POST['filterInput'])) {
    $sql = "select
            student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, 
            Sclass, Stel, Saddress, Sstay, Rno, student_room.Bno
        from student 
            join student_room on student.Sno = student_room.Sno
            join build_admin on student_room.Bno = build_admin.Bno
        where 
            Sin = 0 and SleftTime = '$_POST[filterInput]' and Ano = '$_SESSION[Aaccount]'";
} else {
    $sql = "select
            student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, 
            Sclass, Stel, Saddress, Sstay, Rno, student_room.Bno
        from student 
            join student_room on student.Sno = student_room.Sno
            join build_admin on student_room.Bno = build_admin.Bno
        where 
            Sin = 0 and Ano = '$_SESSION[Aaccount]'";
}

queryWithBtn($sql);

function queryWithBtn($sql) {
    global $conn;
    $result = $conn->query($sql);
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
                echo("<button class='btn btn-default set-in'>设为在校</button>");
                echo("</th>");
            }
        }
        echo("</tr>");
    }
}