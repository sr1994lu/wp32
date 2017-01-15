<?php
/**
 * @src 09/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/dao/DeptDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/dao/EmpDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$tplPath = 'emp/empAdd.tpl';

if (isset($_SESSION['flashMsg'])) {
    $flashMsg = $_SESSION['flashMsg'];

    $smarty->assign('flashMsg', $flashMsg);
    unset($_SESSION['flashMsg']);
}

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $empDAO = new EmpDAO($db);
    $deptDAO = new DeptDAO($db);

    $deptList = $deptDAO->findAll();
    $empList = $empDAO->findAll();
    $mgrList = $empDAO->mgrMap();

    $smarty->assign('deptList', $deptList);
    $smarty->assign('emp', new Emp());
    $smarty->assign('empList', $empList);
    $smarty->assign('mgrList', $mgrList);
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$deptList = [];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);

    $dept = $deptDAO->findAll();

    $smarty->assign('dept', $dept);
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
