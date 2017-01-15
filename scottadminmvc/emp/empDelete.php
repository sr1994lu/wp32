<?php
/**
 * @src 14/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/EmpDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$isRedirect = false;

$tplPath = 'error.tpl';

$deleteEmpEmpno = $_POST['deleteEmpEmpno'];

try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $empDAO = new EmpDAO($db);

    $result = $empDAO->delete($deleteEmpEmpno);

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
    header('Location: /oh/wp32/scottadminmvc/emp/showEmpList.php');

    exit;
} else {
    $smarty->display($tplPath);
}
