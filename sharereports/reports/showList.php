<?php
/**
 * @src 08/18
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/libs/SmartyBC.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/entity/Reports.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/dao/ReportsDAO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/config/Functions.php';

$smarty = new SmartyBC();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates/');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/sharereports/templates_c/');
$smarty->php_handling = Smarty::PHP_ALLOW;

$tplPath = 'reports/list.tpl';

if (loginCheck()) {
    $validationMsgs[] = 'ログインしていないか、前回ログインから一定時間が経過しています。もう一度ログインしなおしてください。';

    $smarty->assign('validationMsgs', $validationMsgs);

    $tplPath = 'login.tpl';
} else {
    if (isset($_SESSION['flashMsg'])) {
        $flashMsg = $_SESSION['flashMsg'];

        $smarty->assign('flashMsg', $flashMsg);
        unset($_SESSION['flashMsg']);
    }

    if (isset($_SESSION['name'])) {
        $smarty->assign('loginName', $_SESSION['name']);
    }

    cleanSession();

    $linePerPage = 10;
    $pageNo = 1;
    $smarty->assign('linePerPage', $linePerPage);
    $smarty->assign('pageNo', $pageNo);

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $pageNo = $_GET['page'];
    }

    $offset = $linePerPage * ($pageNo - 1);
    $smarty->assign('offset', $offset);

    $nextPageNo = $pageNo + 1;
    $smarty->assign('nextPageNo', $nextPageNo);

    $reportList = [];

    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $reportDAO = new ReportsDAO($db);

        $sqlCount = 'SELECT COUNT(*) AS count FROM reports';
        $stmt = $db->prepare($sqlCount);

        $result = $stmt->execute();

        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rowCount = $row['count'];
            $smarty->assign('rowCount', $rowCount);
        }

        $totalPage = ceil($rowCount / $linePerPage);
        $smarty->assign('totalPage', $totalPage);

        $sqlList = 'SELECT * FROM reports ORDER BY id LIMIT :limit OFFSET :offset';
        $stmt = $db->prepare($sqlList);

        $stmt->bindValue(':limit', $linePerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $result = $stmt->execute();

        $reportList = $reportDAO->findAll();

        // $reports = new Reports();

        // $reports->setRpDate(date('Y年m月d日', strtotime($reports->getRpDate())));

        $smarty->assign('reportList', $reportList);
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
