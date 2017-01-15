<?php
/**
 * @src 15/26
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/DeptDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Functions.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');

$tplPath = 'dept/deptList.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしていないか、前回ログインから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    if (isset($_SESSION['flashMsg'])) {
        $flashMsg = $_SESSION['flashMsg'];

        $smarty->assign('flashMsg', $flashMsg);

        unset($_SESSION['flashMsg']);
    }

    cleanSession();

    $deptList = [];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $deptDAO = new DeptDAO($db);

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $smarty->assign('keyword', $keyword);

            $deptList = $deptDAO->findByDnameKeyword($keyword);
        } else {
            $deptList = $deptDAO->findAll();
        }

        $smarty->assign('deptList', $deptList);
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
