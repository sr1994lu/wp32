<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminkan/classes/Conf.php';

session_destroy();

header('Location: /oh/wp32/scottadminkan/index.php');

exit;
