<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Emp.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/dao/EmpDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/dao/DeptDAO.class.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$isRedirect = false;

$tplPath = 'emp/empAdd.tpl';

$addEmpEmpno = $_POST['addEmpEmpno'];
$addEmpEname = $_POST['addEmpEname'];
$addEmpJob = $_POST['addEmpJob'];
$addEmpMgr = $_POST['addEmpMgr'];
$addEmpHiredate = $_POST['HireYear'].'-'.$_POST['HireMonth'].'-'.$_POST['HireDay'];
$addEmpSal = $_POST['addEmpSal'];
$addEmpComm = $_POST['addEmpComm'];
$addEmpDeptno = $_POST['addEmpDeptno'];

$addEmpEmpno = trim($addEmpEmpno);
$addEmpEname = trim($addEmpEname);
$addEmpJob = trim($addEmpJob);
$addEmpMgr = trim($addEmpMgr);
$addEmpHiredate = trim($addEmpHiredate);
$addEmpSal = trim($addEmpSal);
$addEmpComm = trim($addEmpComm);
$addEmpDeptno = trim($addEmpDeptno);

$emp = new Emp();
$emp->setEmpno($addEmpEmpno);
$emp->setEname($addEmpEname);
$emp->setJob($addEmpJob);
$emp->setMgr($addEmpMgr);
$emp->setHiredate($addEmpHiredate);
$emp->setSal($addEmpSal);
$emp->setComm($addEmpComm);
$emp->setDeptno($addEmpDeptno);

$validationMsgs = [];

// 従業員番号が4桁の数値かどうかのチェック
if (strlen($addEmpEmpno) == 0) {
    $validationMsgs[] = '従業員番号の入力は必須です。';
} elseif (!is_numeric($addEmpEmpno)) {
    $validationMsgs[] = '従業員番号は4桁の数値を入力してください。';
} elseif (strlen($addEmpEmpno) != 4) {
    $validationMsgs[] = '従業員番号は4桁の数値を入力してください。';
}

// 給与が数値かどうかのチェック
if (strlen($addEmpSal) == 0) {
    $validationMsgs[] = '給与の入力は必須です。';
} elseif (!is_numeric($addEmpSal)) {
    $validationMsgs[] = '給与は4桁の数値を入力してください。';
}

// 歩合が数値かどうかのチェック
if (strlen($addEmpComm) == 0) {
    $validationMsgs[] = '歩合の入力は必須です。';
} elseif (!is_numeric($addEmpComm)) {
    $validationMsgs[] = '歩合は4桁の数値を入力してください。';
}

if (strlen($addEmpEname) == 0) {
    $validationMsgs[] = '従業員名の入力は必須です。';
}
if (strlen($addEmpJob) == 0) {
    $validationMsgs[] = '役職の入力は必須です。';
}
if (strlen($addEmpMgr) == 0) {
    $validationMsgs[] = '上司番号の入力は必須です。';
}
if (strlen($addEmpHiredate) == 0) {
    $validationMsgs[] = '雇用日の入力は必須です。';
}
if (strlen($addEmpDeptno) == 0) {
    $validationMsgs[] = '部門番号の入力は必須です。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $empDAO = new EmpDAO($db);

        $empDB = $empDAO->findByPK($emp->getEmpno());

        if (!empty($empDB)) {
            $validationMsgs[] = 'その部門番号はすでに使われています。別のものを指定してください。';
        } else {
            $result = $empDAO->insert($emp);

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
    header('Location: /oh/wp32/scottadminadv/emp/showEmpList.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('emp', $emp);

        try {
            $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
            $empDAO = new EmpDAO($db);
            $deptDAO = new DeptDAO($db);

            $deptList = $deptDAO->findAll();
            $empList = $empDAO->findAll();
            $mgrList = $empDAO->mgrMap();

            $smarty->assign('deptList', $deptList);
            $smarty->assign('empList', $empList);
            $smarty->assign('mgrList', $mgrList);

            (string) $time = strtotime($emp->getHiredate());
            $timeY = date('Y', $time);
            $timeM = date('m', $time);
            $timeD = date('d', $time);

            $smarty->assign('timeY', $timeY);
            $smarty->assign('timeM', $timeM);
            $smarty->assign('timeD', $timeD);
        } catch (PDOException $e) {
            print_r($e);
            var_dump($e);

            $smarty->assign('errorMsg', 'DB接続に失敗しました。');

            $tplPath = 'error.tpl';
        } finally {
            $db = null;
        }
    }

    $smarty->display($tplPath);
}
