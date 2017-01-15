<?php
/**
 * @src 11/25
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/entity/User.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/dao/UserDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');

$isRedirect = false;
$tplPath = 'login.tpl';

// post
$loginId = $_POST['loginId'];
$loginPw = $_POST['loginPw'];

// trim
$loginId = trim($loginId);
$loginPw = trim($loginPw);

$validationMsgs = [];

if (strlen($loginId) == 0) {
    $validationMsgs[] = 'IDを入力してください。';
}

if (strlen($loginPw) == 0) {
    $validationMsgs[] = 'パスワードを入力してください。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $userDAO = new UserDAO($db);

        $user = $userDAO->findByLoginId($loginId);

        if ($user == null) {
            $validationMsgs[] = '存在しないIDです。正しいIDを入力してください。';
        } else {
            $userPw = $user->getPasswd();

            if ($loginPw == $userPw) {
                $id = $user->getID();
                $nameLast = $user->getNameLast();
                $nameFirst = $user->getNameFirst();

                $_SESSION['loginFlg'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $nameLast.' '.$nameFirst;
                $_SESSION['auth'] = 1;
                $isRedirect = true;
            } else {
                $validationMsgs[] = 'パスワードが違います。正しいパスワードを入力してください。';
            }
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
    header('Location: /oh/wp32/scottadminkan/goTop.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('loginId', $loginId);
    }

    $smarty->display($tplPath);
}
