<?php

if (!session_id()) session_start();

// get Conn
function getConn(): mysqli
{
    // [注] 在此连接数据库
    $conn = new mysqli("127.0.0.1", "lk", "1234", "RMS");
    if ($conn->connect_error) {
        die("connect fail: " . $conn->connect_error);
    }
    return $conn;
}

function checkAdminLogin()
{
    if (empty($_SESSION["AHasLogin"]) || $_SESSION["AHasLogin"] == false) {
        // error=2 未登录或登录失效
        header("location: signinAsAdmin.php?error=2");
        exit;
    }
}

function checkStuLogin()
{
    if (empty($_SESSION["SHasLogin"]) || $_SESSION["SHasLogin"] == false) {
        // error=2 未登录或登录失效
        header("location: signinAsStu.php?error=2");
        exit;
    }
}

function errorInfo()
{
    if (!empty($_GET['error'])) { ?>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php
                        switch ($_GET['error']) {
                            case 1:
                                ?>
                                <h4>Warning</h4>
                                <strong>账号或密码错误</strong>
                                <a href="#" class="alert-link">找回密码</a>
                                <?php
                                break;
                            case 2:
                                ?>
                                <h4>Warning</h4>
                                <strong>未登录或登录失效</strong>
                                <?php
                                break;
                            case 3:
                                ?>
                                <h4>Warning</h4>
                                <strong>修改失败</strong>
                            <?php
                            default:
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>