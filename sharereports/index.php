<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Conf.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates_c/');

$tplPath = 'login.tpl';

$smarty->display($tplPath);
