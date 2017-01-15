<?php
/**
 * @src 09/25
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/templates_c/');

$tplPath = 'login.tpl';

$smarty->display($tplPath);
