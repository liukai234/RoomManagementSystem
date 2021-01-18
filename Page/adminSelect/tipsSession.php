
<?php
include_once "../headFile.php";
checkAdminLogin();
$conn = getConn();

echo(tipsSessionFunction());

function tipsSessionFunction(): string {
    if (!empty($_POST['selectSno'])) {
        $tipsSession = "学号为：{$_POST['selectSno']} 的信息";
        $_SESSION['tips'] = 'Sno';

    } else if (!empty($_POST['selectRoom'])) {
        $tipsSession1 = "{$_POST['selectBuild']}栋 ";
        $tipsSession2 = "{$_POST['selectFloor']}层 ";
        $tipsSession3 = "#{$_POST['selectRoom']} 的信息";

        if (empty($_POST['selectFloor'])) {
            $tipsSession = $tipsSession1 . $tipsSession3;
            $_SESSION['tips'] = 'RoomWithoutFloor';

        } else {
            $tipsSession = $tipsSession1 . $tipsSession2 . $tipsSession3;
            $_SESSION['tips'] = 'RoomWithFloor';
        }

    } else if (!empty($_POST['selectFloor'])) {
        $tipsSession = "{$_POST['selectBuild']}栋 {$_POST['selectFloor']}层 的信息";
        $_SESSION['tips'] = 'Floor';

    } else {
        $tipsSession = "{$_POST['selectBuild']}栋 的已分配楼层";
        $_SESSION['tips'] = 'Build';

    }
    return $tipsSession;
}

