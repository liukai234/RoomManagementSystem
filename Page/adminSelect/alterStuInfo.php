<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$conn->begin_transaction();

try {
    $sqlALterStuInfo = "
        update 
            student 
            join student_room on student.Sno = student_room.Sno 
        set 
            student.Sno = '$_POST[Sno]', Sname = '$_POST[Sname]', Spasswd = '$_POST[Spasswd]',
            Ssex = '$_POST[Ssex]',Sdepartment = '$_POST[Sdepartment]',SleftTime = '$_POST[SleftTime]',
            Sclass = '$_POST[Sclass]', Stel = '$_POST[Stel]',Saddress = '$_POST[Saddress]',
            Sin = '$_POST[Sin]',Sstay = '$_POST[Sstay]' 
        where student.Sno = '$_POST[Sno]'";

    $sqlALterStu_RoomInfo = "
        update
            student_room
        set
            Sno = '$_POST[Sno]', Rno = '$_POST[Rno]', Bno = '$_POST[Bno]'
        where Sno = '$_POST[Sno]'";

    $sqlAlterRoom = "
        update
            room
        set
            Rcapacity = '$_POST[Rcapacity]', Rfloor = '$_POST[Rfloor]'
        where Rno = '$_POST[Rno]' and Bno = '$_POST[Bno]'";

    $result = $conn->query($sqlALterStuInfo);
    $result = $conn->query($sqlALterStu_RoomInfo);
    $result = $conn->query($sqlAlterRoom);

    $conn->commit();
} catch (mysqli_sql_exception $exception) {
    $conn->rollback();
    throw $exception;
}
