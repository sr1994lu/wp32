<?php
/**
 * @src 14/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/DeptDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');

$isRedirect = false;

$tplPath = 'error.tpl';

$deleteDeptDeptno = $_POST['deleteDeptDeptno'];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);

    $result = $deptDAO->delete($deleteDeptDeptno);

    if ($result) {
        $isRedirect = true;
    } else {
        $smarty->assign('errorMsg', '情報登録に失敗しました。もう一度はじめからやり直してください。');
    }
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');
} finally {
    $db = null;
}

if ($isRedirect) {
    $_SESSION['flashMsg'] = '部門情報を削除しました。';
    header('Location: /oh/wp32/scottadminmvc/dept/showDeptList.php');

    exit;
} else {
    $smarty->display($tplPath);
}
