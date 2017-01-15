<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/DeptDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/EmpDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Functions.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$tplPath = 'emp/empList.tpl';

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

    $empList = [];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);
        $deptDAO = new DeptDAO($db);

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $smarty->assign('keyword', $keyword);

            $empList = $empDAO->findByEnameKeyword($keyword);
        } else {
            $deptList = $deptDAO->findAll();
            $empList = $empDAO->findAll();

            $smarty->assign('deptList', $deptList);
        }

        $deptList = $deptDAO->findAll();

        $smarty->assign('deptList', $deptList);
        $smarty->assign('empList', $empList);

        if (isset($_SESSION['name'])) {
            $smarty->assign('loginName', $_SESSION['name']);
        }
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
