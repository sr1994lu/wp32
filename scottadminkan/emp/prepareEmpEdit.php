<?php
/**
 * @src 11/18
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

$tplPath = 'emp/empEdit.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    $editEmpEmpno = $_POST['editEmpEmpno'];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);
        $deptDAO = new DeptDAO($db);

        $deptList = $deptDAO->findAll();
        $emp = $empDAO->findByPK($editEmpEmpno);
        $empList = $empDAO->findAll();
        $mgrList = $empDAO->mgrMap();

        $smarty->assign('deptList', $deptList);
        $smarty->assign('emp', $emp);
        $smarty->assign('empList', $empList);
        $smarty->assign('mgrList', $mgrList);

        (string) $time = strtotime($emp->getHiredate());
        $timeY = date('Y', $time);
        $timeM = date('m', $time);
        $timeD = date('d', $time);

        $smarty->assign('timeY', $timeY);
        $smarty->assign('timeM', $timeM);
        $smarty->assign('timeD', $timeD);

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
