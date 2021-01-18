<?php
include_once "../../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select 
            Ano, Apasswd, Aname, Asex, Atel
        from admin 
        where Ano = $_SESSION[Aaccount]";

$result = $conn->query($sql);
$columns = $result->field_count;

$head_array = array();
for ($i = 0; $head = $result->fetch_field(); $i++) {
    $head_array[$i] = $head->name;
}
$row = $result->fetch_array();
?>

<h2 class="sub-header"><?php echo $row['Aname'] ?></h2>
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
                echo("<button class='btn btn-default alter-admin-info'>修改</button>");
                echo("</div>");
                echo("</th>");
            }
        }

        ?>
        </tr>
        </tbody>
    </table>
</div>