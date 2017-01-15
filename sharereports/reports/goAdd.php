<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/entity/Reports.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/dao/ReportsDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Functions.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');

$tplPath = 'reports/add.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    if (isset($_SESSION['flashMsg'])) {
        $flashMsg = $_SESSION['flashMsg'];

        $smarty->assign('flashMsg', $flashMsg);
        unset($_SESSION['flashMsg']);
    }

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $reports = new Reports();

        $smarty->assign('reports', $reports);

        if (isset($_SESSION['name'])) {
            $smarty->assign('loginName', $_SESSION['name']);
        }
    } catch (PDOException $e) {
        print_r($e);

        $smarty->assign('errorMsg', 'DB接続に失敗しました。');

        $tplPath = 'error.tpl';
    } finally {
        $db = null;
    }
}

$smarty->display($tplPath);
