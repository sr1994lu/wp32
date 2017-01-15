<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/DeptDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');

$isRedirect = false;

$tplPath = 'dept/deptAdd.tpl';

$addDeptDeptno = $_POST['addDeptDeptno'];
$addDeptDname = $_POST['addDeptDname'];
$addDeptLoc = $_POST['addDeptLoc'];
$addDeptDeptno = trim($addDeptDeptno);
$addDeptDname = trim($addDeptDname);
$addDeptLoc = trim($addDeptLoc);

$dept = new Dept();
$dept->setDeptno($addDeptDeptno);
$dept->setDname($addDeptDname);
$dept->setLoc($addDeptLoc);

$validationMsgs = [];

if (strlen($addDeptDeptno) == 0) {
    $validationMsgs[] = '部門番号の入力は必須です。';
} else {
    if (!is_numeric($addDeptDeptno)) {
        $validationMsgs[] = '部門番号は2桁の数値を入力してください。';
    } else {
        if (strlen($addDeptDeptno) != 2) {
            $validationMsgs[] = '部門番号は2桁の数値を入力してください。';
        }
    }
}
if (strlen($addDeptDname) == 0) {
    $validationMsgs[] = '部門名の入力は必須です。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $deptDAO = new DeptDAO($db);

        $deptDB = $deptDAO->findByPK($dept->getDeptno());

        if (!empty($deptDB)) {
            $validationMsgs[] = 'その部門番号はすでに使われています。別のものを指定してください。';
        } else {
            $result = $deptDAO->insert($dept);

            if ($result) {
                $isRedirect = true;
            } else {
                $smarty->assign('errorMsg', '情報登録に失敗しました。もう一度はじめからやり直してください。');

                $tplPath = 'error.tpl';
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
    $_SESSION['flashMsg'] = '部門情報を登録しました。';
    header('Location: /oh/wp32/scottadminmvc/dept/showDeptList.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('dept', $dept);
    }

    $smarty->display($tplPath);
}
