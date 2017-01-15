<?php
/**
 * @src 22/25
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

    $tplPath = 'dept/deptEdit.tpl';

    $editDeptDeptno = $_POST['editDeptDeptno'];
    $editDeptDname = $_POST['editDeptDname'];
    $editDeptLoc = $_POST['editDeptLoc'];
    $editDeptDname = trim($editDeptDname);
    $editDeptLoc = trim($editDeptLoc);

    $dept = new Dept();
    $dept->setDeptno($editDeptDeptno);
    $dept->setDname($editDeptDname);
    $dept->setLoc($editDeptLoc);

    $validationMsgs = [];

    if (strlen($editDeptDname) == 0) {
        $validationMsgs[] = '部門名の入力は必須です。';
    }

    $restartMsgs = '情報登録に失敗しました。もう一度はじめからやり直してください。';

    if (empty($validationMsgs)) {
        try {
            $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $deptDAO = new DeptDAO($db);

            $result = $deptDAO->update($dept);

            if ($result) {
                $isRedirect = true;
            } else {
                $smarty->assign('errorMsg', $restartMsgs);

                $tplPath = 'error.tpl';
            }
        } catch (PDOException $e) {
            print_r($e);

            $smarty->assign('errorMsg', 'DB接続に失敗しました。');

            $tplPath = 'error.tpl';
        } finally {
            $db = null;
        }
    }

    if ($isRedirect) {
        $_SESSION['flashMsg'] = '部門情報を編集しました。';
        header('Location: /oh/wp32/scottadminkan/dept/showDeptList.php');

        exit;
    } else {
        if (!empty($validationMsgs)) {
            $smarty->assign('validationMsgs', $validationMsgs);
            $smarty->assign('dept', $dept);
        }

        $smarty->display($tplPath);
    }
}
