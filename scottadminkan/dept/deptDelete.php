<?php
/**
 * @src 25/25
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/DeptDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Functions.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');

if (loginCheck()) {
    $validationMsgs[] = 'ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    $isRedirect = false;

    $tplPath = 'error.tpl';

    $deleteDeptDeptno = $_POST['deleteDeptDeptno'];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
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
        header('Location: /oh/wp32/scottadminkan/dept/showDeptList.php');

        exit;
    } else {
        $smarty->display($tplPath);
    }
}
