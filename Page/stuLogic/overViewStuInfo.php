<?php
include_once "../headFile.php";
checkStuLogin();
$conn = getConn();

$sql = "select 
            student.Sno, Spasswd, Sname, Ssex, Sdepartment, SleftTime, 
            Sclass, Stel, Saddress, Sin, Sstay, room.Rno, room.Bno, Rcapacity, Rfloor
        from student 
            join student_room on student.Sno = student_room.Sno 
            join room on room.Rno = student_room.Rno and room.Bno = student_room.Bno
        where student.Sno = $_SESSION[Saccount]";

$result = $conn->query($sql);
$columns = $result->field_count;

$head_array = array();
for ($i = 0; $head = $result->fetch_field(); $i++) {
    $head_array[$i] = $head->name;
}
$row = $result->fetch_array();
?>

<h2 class="sub-header"><?php echo $row['Sname'] ?></h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <?php
            for ($i = 0; $i < count($head_array); $i ++) {
                echo("<th>{$head_array[$i]}</th>");
                if($i == count($head_array) - 1) {
                    echo("<th>选项</th>");
                }
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <tr>
        <?php

        for ($i = 0; $i < $columns; $i++) {
            echo("<th class='$head_array[$i]' style='padding-top: 15px'>$row[$i]</th>");
            if ($i == $columns - 1) {
                echo("<th>");
                echo("<div class='alter-btn-group'>");
                echo("<button class='btn btn-default alter-stu-info'>修改</button>");
                echo("</div>");
                echo("</th>");
            }
        }

        ?>
        </tr>
        </tbody>
    </table>
</div>