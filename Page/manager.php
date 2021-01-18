<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>manage Page</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="jq-ui/jquery-ui.css" rel="stylesheet">
    <link href="css/manage.css" rel="stylesheet">
    <link href="css/profileSettings.css" rel="stylesheet">
</head>

<body>
<?php
include_once "headFile.php";
checkAdminLogin();
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="manager.php">Admin Page</a>
            <a class="navbar-brand" href="logout.php">退出</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li id="admin_button" class="active"><a href="#">个人信息<span class="sr-only">(current)</span></a></li>
                <li id="room_button"><a href="#">宿舍信息</a></li>
                <li id="in_button"><a href="#">在校登记</a></li>
            </ul>
            <!--<ul class="nav nav-sidebar">
                <li id="stay_button"><a href="#">住/跑校生</a></li>
            </ul>-->
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php
            $conn = getConn();

            $account = $_SESSION['Aaccount'];

            $sql = "select Ano, Apasswd, Aname, Asex, Atel from RMS.admin where Ano = '$account'";
            $result_admin = $conn->query($sql);
            $columns_admin = $result_admin->field_count;
            $row_admin = $result_admin->fetch_array();
            ?>

            <!--个人信息-->
            <div class="admin-info"></div>

            <!--宿舍信息-->
            <div class='room_info hidden'>
                <h2 class="page-header">宿舍信息</h2>
                <div class="row">
                    <form class="form col-md-6 column" id="form_select" style="margin-top: 10px">
                        <div class="form-group">
                            <label for="selectBuild">Bno</label>
                            <select class="form-control" id="selectBuild" name="selectBuild">
                                <?php
                                $sql = "select distinct Bno from build_admin where Ano = '$account'";
                                $result_build = $conn->query($sql);
                                while ($row_build = $result_build->fetch_row()) {
                                    echo("<option>{$row_build['0']}</option>");
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectFloor">Floor</label>
                            <input type="text" class="form-control" id="selectFloor" name="selectFloor" placeholder="Default value of Floor is Null">
                        </div>

                        <div class="form-group">
                            <label for="selectRoom">Rno</label>
                            <input type="text" class="form-control" id="selectRoom" name="selectRoom" placeholder="Default value of Room is Null">
                        </div>

                        <div class="form-group">
                            <label for="selectSno">Sno</label>
                            <input type="text" class="form-control" id="selectSno" name="selectSno" placeholder="Default value of Sno is Null">
                        </div>

                        <!--TODO 年级-->
                        <!--<div class="form-group">
                            <label for="selectGrade">年级</label>
                            <input type="text" class="form-control" id="selectGrade" name="selectGrade" placeholder="1">
                        </div>-->
                    </form>

                    <!--新建宿舍表单-->
                    <div class="form col-md-6 column hidden" id="addRoomForm">
                        <form style="margin-top: 10px">
                            <?php
                            $sql = "select * from RMS.room LIMIT 0";
                            $result_add_room = $conn->query($sql);
                            while ($head = $result_add_room->fetch_field()) {
                                ?>
                                <div class="form-group">
                                    <label for="<?php echo $head->name ?>"><?php echo $head->name ?></label>
                                    <input type="text" class="form-control" name="<?php echo $head->name ?>"
                                           placeholder="<?php echo $head->name ?>">
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                        <div id="add-btn-group">
                            <button type="submit" class="btn btn-success" id="addRoomSubmitBtn" style="margin-right: 5px">提交</button>
                            <button type="submit" class="btn btn-default" id="addRoomSubmitCancelBtn">取消</button>
                        </div>
                    </div>

                    <!--新建学生表单-->
                    <div class="form col-md-6 column hidden" id="addStuForm">
                        <form style="margin-top: 10px">
                            <?php
                            $sql = "select * from RMS.student LIMIT 1";
                            $result_add_room = $conn->query($sql);
                            while ($head = $result_add_room->fetch_field()) {
                                ?>
                                <div class="form-group">
                                    <label for="<?php echo $head->name ?>"><?php echo $head->name ?></label>
                                    <input type="text" class="form-control" name="<?php echo $head->name ?>"
                                           placeholder="<?php echo $head->name ?>">
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $sql = "select * from RMS.student_room LIMIT 1";
                            $result_add_room = $conn->query($sql);
                            for ($i = 0; $head = $result_add_room->fetch_field(); $i = 1) {
                                if ($i == 0) continue;
                                ?>
                                <div class="form-group">
                                    <label for="<?php echo $head->name ?>"><?php echo $head->name ?></label>
                                    <input type="text" class="form-control" name="<?php echo $head->name ?>"
                                           placeholder="<?php echo $head->name ?>">
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                        <button type="submit" class="btn btn-success" id="addStuSubmitBtn" style="margin-right: 5px">
                            提交
                        </button>
                        <button type="submit" class="btn btn-default" id="addStuSubmitCancelBtn">取消</button>
                    </div>
                </div>

                <div class="row" id="find-info-btn-group">
                    <div class="col-md-12 column">
                        <!--概览 显示所有楼以及管理权限-->
                        <button class="btn btn-default" id="overView" style="margin-right: 5px">概览</button>
                        <button class="btn btn-default" id="findInfo" style="margin-right: 10px">查询</button>
                        <button class="btn btn-success" id="addRoomBtn" style="margin-right: 5px">新建宿舍</button>
                        <button class="btn btn-success" id="addStuBtn">新增学生</button>
                    </div>
                </div>


                <!--概览btn-->
                <h3 class="sub-header" id="tips-session">宿舍楼分配情况概览</h3>
                <!--为概览按钮增加js事件监听，从php模型.load页面-->
                <!--默认加载-->
                <div class="table-responsive" id="default_build_info">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <!--存放表头<th></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <!--while(){<tr>for(){<th></th>}</tr>}-->
                        </tbody>
                    </table>
                </div>
            </div>

            <!--不在校学生信息-->
            <div class='in_info hidden'>
                <h2 class="sub-header">日期筛选</h2>
                <div class="row">
                    <form class="form-inline col-md-12 column" id="ontAtFilter" style="margin-top: 10px">
                        <div class="form-group">
                            <label for="ontAtSchool"></label>
                            <div class="input-group">
                                <div class="input-group-addon">离校时间：</div>
                                <input type="text" class="form-control" id="ontAtSchool" name="ontAtSchool" placeholder="Example: 2020/1/1">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="onAtFilterSubmit">筛选</button>
                    </form>
                </div>

                <h2 class="sub-header">不在校学生</h2>
                    <div class="table-responsive">
                    <table class="table table-striped" id="not-at-info">
                        <thead>
                        <tr>
                            <!--存放表头<th></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <!--while(){<tr>for(){<th></th>}</tr>}-->
                        </tbody>
                    </table>
                </div>
            </div>

<!--
            <div class='stay_info hidden'>
                <h2 class="sub-header">住/跑校学生</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Header</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1,001</td>
                            <td>lemon</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
-->
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="jq-ui/jquery-ui.js"></script>
<script src="js/manager.js"></script>
</body>
</html>
