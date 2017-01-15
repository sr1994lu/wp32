<?php
/**
 * @src 09/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Dept.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/');
$tplPath = 'dept/deptAdd.tpl';

$smarty->assign('dept', new Dept());
$smarty->display($tplPath);
