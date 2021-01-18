<?php
include_once "../../headFile.php";
$conn = getConn();
checkAdminLogin();

$sql = "select 
            Ano, Apasswd, Aname, Asex, Atel
        from admin
        where Ano = '$_POST[Ano]'";

$result = $conn->query($sql);
$columns = $result->field_count;
$row = $result->fetch_array();
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
                       value="<?php echo $row[$i] ?>">
            </div>
        </th>
        <?php
    }
    ?>
</form>
<th>
    <div class="done-btn-group">
        <button id = "doneAlterAdminInfo" class="btn btn-success">确定</button>
        <button id = "cancelAlterInfo" class="btn btn-default">取消</button>
    </div>
</th>

