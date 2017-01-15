<?php
/**
 * @src 09/13
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/entity/Photo.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates_c');

$tplPath = 'photo/photoAdd.tpl';

$smarty->assign('photo', new Photo());

$smarty->display($tplPath);
