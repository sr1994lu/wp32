<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/DeptDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/EmpDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$tplPath = 'emp/empList.tpl';

if (isset($_SESSION['flashMsg'])) {
    $flashMsg = $_SESSION['flashMsg'];

    $smarty->assign('flashMsg', $flashMsg);
    unset($_SESSION['flashMsg']);
}

$empList = [];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $empDAO = new EmpDAO($db);
    $deptDAO = new DeptDAO($db);

    $deptList = $deptDAO->findAll();
    $empList = $empDAO->findAll();

    $smarty->assign('deptList', $deptList);
    $smarty->assign('empList', $empList);
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
