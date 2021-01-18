<?php
include_once "../headFile.php";
checkStuLogin();
$conn = getConn();

$sql = "select 
            admin.Ano, Aname, Asex, Atel
        from 
            student
            join student_room on student.Sno = student_room.Sno
            join build_admin on student_room.Bno = build_admin.Bno
            join admin on build_admin.Ano = admin.Ano
        where 
            student.Sno = $_SESSION[Saccount]";

$result = $conn->query($sql);
$columns = $result->field_count;
?>

<h2 class="sub-header">宿管信息</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <?php
            while ($head = $result->fetch_field()) {
                echo("<th>$head->name</th>");
            }
            ?>
        </tr>
        </thead>
        <tbody>

        <?php
        while ($row = $result->fetch_array()) {
            echo("<tr>");
            for ($i = 0; $i < $columns; $i++) {
                echo("<th class='$row[$i]' style='padding-top: 15px'>$row[$i]</th>");
            }
            echo("</tr>");
        }
        ?>

        </tbody>
    </table>
</div>