<?php
/**
 * @src 13/25
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Functions.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__.'/templates/');
$smarty->setCompileDir(__DIR__.'/templates_c/');

if (loginCheck()) {
    $validationMsgs[] = 'ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    if (isset($_SESSION['name'])) {
        $smarty->assign('loginName', $_SESSION['name']);
    }

    cleanSession();

    $tplPath = 'top.tpl';
}

$smarty->display($tplPath);
