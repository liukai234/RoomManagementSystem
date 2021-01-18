<?php

include_once "../../headFile.php";
checkAdminLogin();
$conn = getConn();

// delete student
// 自我查询
$sql = "delete student_room, student
        from student_room
            join student on student.Sno = student_room.Sno
        where student_room.Sno in (
            select A.Sno
            from (
                 select student.Sno
                 from student
                      join student_room on student.Sno = student_room.Sno
                      join build_admin on student_room.Bno = build_admin.Bno
                 where 
                    student.Sno = '$_POST[Sno]' and build_admin.Ano = '$_SESSION[Aaccount]'
            ) as A
        )";

$result = $conn->query($sql);
$conn->close();
//echo($sql);
//echo($result);
//header("location: student.php");
//if ($result != true) {
////    TODO 违规操作提示
////    header("location: student.php");
////    exit;
//} else {
//    header("location: student.php");
//}
