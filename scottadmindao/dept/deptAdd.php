<?php
/**
 * WP32 09/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

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
} elseif (!is_numeric($addDeptDeptno)) {
    $validationMsgs[] = '部門番号は2桁の数値を入力してください。';
} elseif (strlen($addDeptDeptno) != 2) {
    $validationMsgs[] = '部門番号は2桁の数値を入力してください。';
}

if (strlen($addDeptDname) == 0) {
    $validationMsgs[] = '部門名の入力は必須です。';
}

$alreadyUseDeptno = 'その部門番号はすでに使われています。別のものを指定してください。';
$failMsg = '情報登録に失敗しました。もう一度はじめからやり直してください。';

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $deptDAO = new DeptDAO($db);
        $deptDB = $deptDAO->findByPK($dept->getDeptno());
        if (!empty($deptDB)) {
            $validationMsgs[] = $alreadyUseDeptno;
        } else {
            $result = $deptDAO->insert($dept);
            if (!$result) {
                $_SESSION['errorMsg'] = $failMsg;
            }
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
    header('Location: /wp32/scottadmindao/dept/goDeptAdd.php');
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
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報追加完了 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
</head>
<body>
  <h1>部門情報追加完了</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報追加</li>
      <li>部門情報追加完了</li>
    </ul>
  </nav>
  <section>
    <p>以下の部門情報を登録しました。</p>
    <form action="./deptAdd.php" method="post">
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
    </form>
  </section>
</body>
</html>
