<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/DeptDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');

$tplPath = 'dept/deptList.tpl';

if (isset($_SESSION['flashMsg'])) {
    $flashMsg = $_SESSION['flashMsg'];

    $smarty->assign('flashMsg', $flashMsg);

    unset($_SESSION['flashMsg']);
}

$deptList = [];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);

    $deptList = $deptDAO->findAll();

    $smarty->assign('deptList', $deptList);
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
