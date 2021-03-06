<?php
/**
 * @src 11/18
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

$tplPath = 'emp/empEdit.tpl';

$editEmpEmpno = $_POST['editEmpEmpno'];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
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
} catch (PDOException $e) {
    print_r($e);
    var_dump($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
