<?php
/**
 * @src 14/18
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

if (loginCheck()) {
    $validationMsgs[] = 'ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    $isRedirect = false;

    $tplPath = 'error.tpl';

    $deleteEmpEmpno = $_POST['deleteEmpEmpno'];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);

        $result = $empDAO->delete($deleteEmpEmpno);

        if (isset($_SESSION['name'])) {
            $smarty->assign('loginName', $_SESSION['name']);
        }

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
        header('Location: /oh/wp32/scottadminkan/emp/showEmpList.php');

        exit;
    } else {
        if (isset($_SESSION['name'])) {
            $smarty->assign('loginName', $_SESSION['name']);
        }

        $smarty->display($tplPath);
    }
}
