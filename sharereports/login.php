<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/entity/User.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/dao/UserDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates_c/');

$isRedirect = false;
$tplPath = 'login.tpl';

// post
$loginMail = $_POST['loginMail'];
$loginPw = $_POST['loginPw'];

// trim
$loginMail = trim($loginMail);
$loginPw = trim($loginPw);

$validationMsgs = [];

if (strlen($loginMail) == 0) {
    $validationMsgs[] = 'IDを入力してください。';
}

if (strlen($loginPw) == 0) {
    $validationMsgs[] = 'パスワードを入力してください。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $userDAO = new UserDAO($db);

        $user = $userDAO->findByLoginId($loginMail);

        if ($user == null) {
            $validationMsgs[] = '存在しないIDです。正しいIDを入力してください。';
        } else {
            $userPw = $user->getPasswd();

            if ($loginPw == $userPw) {
                $id = $user->getID();
                $name = $user->getName();
                $mail = $user->getMail();

                $_SESSION['loginFlg'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['mail'] = $mail;
                $_SESSION['name'] = $name;
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
    header('Location: /oh/wp32/sharereports/reports/showList.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('loginMail', $loginMail);
    }

    $smarty->display($tplPath);
}
