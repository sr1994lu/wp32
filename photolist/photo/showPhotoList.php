<?php
/**
 * @src07/13
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/entity/Photo.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/dao/PhotoDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates_c');

$tplPath = 'photo/photoList.tpl';

if (isset($_SESSION['flashMsg'])) {
    $flashMsg = $_SESSION['flashMsg'];

    $smarty->assign('flashMsg', $flashMsg);

    unset($_SESSION['flashMsg']);
}

$photoList = [];

try {
    $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $photoDAO = new PhotoDAO($db);

    $photoList = $photoDAO->findAll();

    $smarty->assign('photoList', $photoList);
    $smarty->assign('upDir', APP_ROOT.UP_FILE_DIR.'/');
} catch (PDOException $e) {
    print_r($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
