<?php
/**
 * @src 07/10
 */

namespace scottadminadv;

use scottadminadv\classes\MySmarty;

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Autoload.php';

$smarty = new MySmarty();

$tplPath = 'index.tpl';

$smarty->display($tplPath);
