<?php
/**
 * WP32 13/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

$restartMsgs = '情報登録に失敗しました。もう一度はじめからやり直してください。';
$deleteDeptDeptno = $_POST['deleteDeptDeptno'];
try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);
    $result = $deptDAO->delete($deleteDeptDeptno);
    if (!$result) {
        $_SESSION['errorMsg'] = $restartMsgs;
    }
} catch (PDOException $e) {
    print_r($e);
    $_SESSION['errorMsg'] = 'DB接続に失敗しました。';
} finally {
    $db = null;
}

if (isset($_SESSION['errorMsg'])) {
    header('Location: /wp32/scottadmindao/error.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報削除完了 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
</head>
<body>
  <h1>部門情報削除完了</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報削除確認</li>
      <li>部門情報削除完了</li>
    </ul>
  </nav>
  <section>
    <p>部門番号<?php echo $deleteDeptDeptno ?>の情報を削除しました。</p>
    <p>部門リストに<a href="./showDeptList.php">戻る</a></p>
  </section>
</body>
</html>
