<?php
// echo ("{$_POST['Rno']}");
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select 
            student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, 
            Sclass, Stel, Saddress, Sin, Sstay, room.Bno, room.Rno, Rcapacity, Rfloor
        from student 
            join student_room on student.Sno = student_room.Sno 
            join room on room.Rno = student_room.Rno and room.Bno = student_room.Bno
        where student.Sno = $_POST[Sno]";

$result = $conn->query($sql);
$columns = $result->field_count; // 列的数量
$row = $result->fetch_array(); // 查询结果混合数组
?>

<form id="formAlterRoomInfo" method="post">
    <?php
    for ($i = 0; $i < $columns; $i++) {
        $head = $result->fetch_field();
        ?>
        <th>
            <div class="form-group">
                <label class="sr-only" for="<?php echo $row[$i] ?>"></label>
                <input type="text" class="form-control"
                       name="<?php echo $head->name ?>"
                       id="<?php echo $head->name ?>"
                       value="<?php echo $row[$i] ?>">
            </div>
        </th>
        <?php
    }
    ?>
</form>
<th>
    <div class="done-btn-group">
        <button id = "doneAlterStuInfo" class="btn btn-success">确定</button>
        <button id = "cancelAlterInfo" class="btn btn-default">取消</button>
    </div>
</th>

