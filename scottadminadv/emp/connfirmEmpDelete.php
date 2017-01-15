<?php
/**
 * @src 13/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/dao/EmpDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$isRedirect = false;

$tplPath = 'emp/confirmEmpDelete.tpl';

$deleteEmpEmpno = $_POST['deleteEmpEmpno'];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $empDAO = new EmpDAO($db);

    $emp = $empDAO->findByPK($deleteEmpEmpno);

    $smarty->assign('emp', $emp);
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
