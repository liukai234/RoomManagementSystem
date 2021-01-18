<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

$sql = "select Rno, Bno, Rcapacity, Rfloor from RMS.room where Rno = '{$_POST['Rno']}' and Bno = '{$_POST['Bno']}'";
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
        <button id = "doneAlterRoomInfo" class="btn btn-success">确定</button>
        <button id = "cancelAlterInfo" class="btn btn-default">取消</button>
    </div>
</th>

