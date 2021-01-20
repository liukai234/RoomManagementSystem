<?php
checkAdminLogin();

function checkAdminLogin()
{
    if (isset($_SESSION["SHasLogin"]) && $_SESSION["SHasLogin"] == true) {
        // error=2 未登录或登录失效
        // header("location: signinAsAdmin.php?error=2");
        // exit;
        echo json_encode(["SHasLogin" => true]);
    }
    else echo json_encode(["SHasLogin" => false]);
}
