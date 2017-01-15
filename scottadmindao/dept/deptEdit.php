<?php
/**
 * WP32 11/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

$editDeptDeptno = $_POST['editDeptDeptno'];
$editDeptDname = $_POST['editDeptDname'];
$editDeptLoc = $_POST['editDeptLoc'];

$editDeptDeptno = trim($editDeptDeptno);
$editDeptDname = trim($editDeptDname);
$editDeptLoc = trim($editDeptLoc);

$dept = new Dept();
$dept->setDeptno($editDeptDeptno);
$dept->setDname($editDeptDname);
$dept->setLoc($editDeptLoc);

$validationMsgs = [];

if (strlen($editDeptDname) == 0) {
    $validationMsgs[] = '部門名の入力は必須です。';
}

$restartMsgs = '情報登録に失敗しました。もう一度はじめからやり直してください。';
if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $deptDAO = new DeptDAO($db);
        $result = $deptDAO->update($dept);
        if (!$result) {
            $_SESSION['errorMsg'] = $restartMsgs;
        }
    } catch (PDOException $e) {
        print_r($e);
        $_SESSION['errorMsg'] = 'DB接続に失敗しました。';
    } finally {
        $db = null;
    }
}

if (!empty($validationMsgs)) {
    $_SESSION['dept'] = serialize($dept);
    $_SESSION['validationMsgs'] = $validationMsgs;
    header('Location: /wp32/scottadmindao/dept/prepareDeptEdit.php');
    exit;
} else {
    if (isset($_SESSION['errorMsg'])) {
        header('Location: /wp32/scottadmindao/error.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報編集完了 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen"
        title="no title">
</head>
<body>
  <h1>部門情報編集完了</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報編集</li>
      <li>部門情報編集完了</li>
    </ul>
  </nav>
  <section>
    <p>以下の部門情報を更新しました。</p>
    <table>
      <tbody>
      <tr>
        <th>部門番号</th>
        <td>
            <?php echo $dept->getDeptno() ?>
        </td>
      </tr>
      <tr>
        <th>部門名</th>
        <td>
            <?php echo $dept->getDname() ?>
        </td>
      </tr>
      <tr>
        <th>所在地</th>
        <td>
            <?php echo $dept->getLoc() ?>
        </td>
      </tr>
      </tbody>
    </table>
    <p>部門リストに<a href="./showDeptList.php">戻る</a></p>
  </section>
</body>
</html>
