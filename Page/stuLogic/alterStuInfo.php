<?php
include_once "../headFile.php";
checkStuLogin();
$conn=getConn();

// 不允许修改的信息这里不准许写入
$sql = "update 
            student 
            join student_room on student.Sno = student_room.Sno 
        set 
            Spasswd = '$_POST[Spasswd]',
            Sdepartment = '$_POST[Sdepartment]', SleftTime = '$_POST[SleftTime]',
            Sclass = $_POST[Sclass], Stel = '$_POST[Stel]', Saddress = '$_POST[Saddress]'
        where student.Sno = '$_POST[Sno]'";

$result = $conn->query($sql);
$conn->close();

// TODO bug 被JavaScript包围无法跳转
if ($result) {
//    header("location: ../student.php");
} else {
    // error=3 修改失败
    header("location: ../student.php?error=3");
    exit;
}
