<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/entity/Reports.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/dao/ReportsDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Functions.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates_c/');

$tplPath = 'reports/detail.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしていないか、前回ログインから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    $detailReportId = $_POST['detailReportId'];

    if (isset($_SESSION['flashMsg'])) {
        $flashMsg = $_SESSION['flashMsg'];

        $smarty->assign('flashMsg', $flashMsg);
        unset($_SESSION['flashMsg']);
    }

    if (isset($_SESSION['name'])) {
        $smarty->assign('loginName', $_SESSION['name']);
    }

    cleanSession();

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $reportDAO = new ReportsDAO($db);

        $reports = $reportDAO->findByPK($detailReportId);

        $smarty->assign('reports', $reports);
    } catch (PDOException $e) {
        print_r($e);
        var_dump($e);

        $smarty->assign('errorMsg', 'DB接続に失敗しました。');

        $tplPath = 'error.tpl';
    } finally {
        $db = null;
    }
}

$smarty->display($tplPath);
