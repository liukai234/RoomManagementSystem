<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

function creatTbodyFunction ($limit) {
    $limit = ' '.$limit;
    switch ($_SESSION['tips']){
        case 'Sno':
            $sql = "select * 
                    from student 
                        join student_room on student.Sno = student_room.Sno 
                    where student.Sno = '$_POST[selectSno]'
                    $limit";

            queryWithBtn($sql, "alterStuInfo", "delStuInfo");
            break;
        case 'RoomWithFloor':
            // room表住Rno和Bno为双主码，即同一栋楼中不会有相同的宿舍号
        case 'RoomWithoutFloor':
            // [!] 其实不必限定权限，因为可查寻楼号的下拉框已经限定楼号是拥有管理权限的
            $sql = "select
                        student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, Sclass, Stel, Saddress, Sin, Sstay,
                        student_room.Bno, student_room.Rno, Rcapacity, Rfloor
                    from student
                        join student_room on student.Sno = student_room.Sno
                        join room on room.Rno = student_room.Rno and room.Bno = student_room.Bno
                        join build_admin on room.Bno = build_admin.Bno
                    where room.Bno = '$_POST[selectBuild]' and room.Rno = '$_POST[selectRoom]' and Ano = '$_SESSION[Aaccount]'
                    $limit";

            queryWithBtn($sql, "alterStuInfo", "delStuInfo");
            break;
        case 'Floor':
            $sql = "select Rno, Bno, Rcapacity, Rfloor 
                    from room
                    where room.Bno = '$_POST[selectBuild]' and Rfloor = '$_POST[selectFloor]'
                    $limit";
            queryWithBtn($sql, "alterRoomInfo", "delRoomInfo");
            break;
        case 'Build':
            $sql = "select distinct Rfloor from room where Bno = '$_POST[selectBuild]' $limit";
            queryWithoutBtn($sql);
            break;
        default:
            echo("<h3>Not Fount</h3>");
            break;
    }
}