<?php
/**
 * @src 12/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/classes/dao/EmpDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminmvc/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$isRedirect = false;

$tplPath = 'emp/empEdit.tpl';

// post
$editEmpEmpno = $_POST['editEmpEmpno'];
$editEmpEname = $_POST['editEmpEname'];
$editEmpJob = $_POST['editEmpJob'];
$editEmpMgr = $_POST['editEmpMgr'];
$editEmpHiredate = $_POST['HireYear'].'-'.$_POST['HireMonth'].'-'.$_POST['HireDay'];
$editEmpSal = $_POST['editEmpSal'];
$editEmpComm = $_POST['editEmpComm'];
$editEmpDeptno = $_POST['editEmpDeptno'];

// trim
$editEmpEmpno = trim($editEmpEmpno);
$editEmpEname = trim($editEmpEname);
$editEmpJob = trim($editEmpJob);
$editEmpMgr = trim($editEmpMgr);
$editEmpHiredate = trim($editEmpHiredate);
$editEmpSal = trim($editEmpSal);
$editEmpComm = trim($editEmpComm);
$editEmpDeptno = trim($editEmpDeptno);

// emp
$emp = new Emp();
$emp->setEmpno($editEmpEmpno);
$emp->setEname($editEmpEname);
$emp->setJob($editEmpJob);
$emp->setMgr($editEmpMgr);
$emp->setHiredate($editEmpHiredate);
$emp->setSal($editEmpSal);
$emp->setComm($editEmpComm);
$emp->setDeptno($editEmpDeptno);

$validationMsgs = [];

// 給与が数値かどうかのチェック
if (strlen($editEmpSal) == 0) {
    $validationMsgs[] = '給与の入力は必須です。';
} elseif (!is_numeric($editEmpSal)) {
    $validationMsgs[] = '給与は4桁の数値を入力してください。';
}

// 歩合が数値かどうかのチェック
if (strlen($editEmpComm) == 0) {
    $validationMsgs[] = '歩合の入力は必須です。';
} elseif (!is_numeric($editEmpComm)) {
    $validationMsgs[] = '歩合は4桁の数値を入力してください。';
}

if (strlen($editEmpEname) == 0) {
    $validationMsgs[] = '従業員名の入力は必須です。';
}
if (strlen($editEmpJob) == 0) {
    $validationMsgs[] = '役職の入力は必須です。';
}
if (strlen($editEmpMgr) == 0) {
    $validationMsgs[] = '上司番号の入力は必須です。';
}
if (strlen($editEmpHiredate) == 0) {
    $validationMsgs[] = '雇用日の入力は必須です。';
}
if (strlen($editEmpDeptno) == 0) {
    $validationMsgs[] = '部門番号の入力は必須です。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);
        $result = $empDAO->update($emp);

        if ($result) {
            $isRedirect = true;
        } else {
            $smarty->assign('errorMsg', '情報登録に失敗しました。もう一度はじめからやり直してください。');

            $tplPath = 'error.tpl';
        }
    } catch (PDOException $e) {
        print_r($e);
        var_dump($e);

        $smarty->assign('errorMsg', 'DB接続に失敗しました。');

        $tplPath = 'error.tpl';
    } finally {
        $db = null;
    }
}

if ($isRedirect) {
    $_SESSION['flashMsg'] = '部門情報を編集しました。';
    header('Location: /oh/wp32/scottadminmvc/emp/showEmpList.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('emp', $emp);
    }

    $smarty->display($tplPath);
}
