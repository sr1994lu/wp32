<?php
/**
 * @src 13/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/EmpDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Functions.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$tplPath = 'emp/confirmEmpDelete.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    $deleteEmpEmpno = $_POST['deleteEmpEmpno'];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);

        $emp = $empDAO->findByPK($deleteEmpEmpno);

        $smarty->assign('emp', $emp);

        if (isset($_SESSION['name'])) {
            $smarty->assign('loginName', $_SESSION['name']);
        }
    } catch (PDOException $e) {
        print_r($e);

        $smarty->assign('errorMsg', 'DB接続に失敗しました。');

        $tplPath = 'error.tpl';
    } finally {
        $db = null;
    }
}

$smarty->display($tplPath);
