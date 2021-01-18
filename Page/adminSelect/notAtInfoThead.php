<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select
            student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, 
            Sclass, Stel, Saddress, Sstay, Rno, student_room.Bno
        from student 
            join student_room on student.Sno = student_room.Sno
            join build_admin on student_room.Bno = build_admin.Bno
        where 
            Sin = 0 and Ano = '$_SESSION[Aaccount]'
        limit 0";

queryWithBtn($sql);

function queryWithBtn($sql) {
    global $conn;
    $result = $conn->query($sql);
    $columns = $result->field_count;

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