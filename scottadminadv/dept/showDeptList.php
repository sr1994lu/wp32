<?php
/**
 * @src 09/10
 */

namespace scottadminadv\dept;

use PDO;
use PDOException;
use scottadminadv\classes\Conf;
use scottadminadv\classes\dao\DeptDAO;
use scottadminadv\classes\entity\Dept;
use scottadminadv\classes\MySmarty;

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Autoload.php';

$smarty = new MySmarty();

$tplPath = 'dept/deptList.tpl';

if (isset($_SESSION['flashMsg'])) {
    $flashMsg = $_SESSION['flashMsg'];

    $smarty->assign('flashMsg', $flashMsg);

    unset($_SESSION['flashMsg']);
}

$deptList = [];

try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);
    $deptDAO = new DeptDAO($db);

    $deptList = $deptDAO->findAll();

    $smarty->assign('deptList', $deptList);
} catch (PDOException $e) {
    print_r($e);
    var_dump($e);

    $smarty->assign('errorMsg', 'DB接続に失敗しました。');

    $tplPath = 'error.tpl';
} finally {
    $db = null;
}

$smarty->display($tplPath);
