<?php
/**
 * WP32 12/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

$deleteDeptDeptno = $_POST['deleteDeptDeptno'];
try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);
    $dept = $deptDAO->findByPK($deleteDeptDeptno);
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
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報削除 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
</head>
<body>
  <h1>部門情報削除</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報削除確認</li>
    </ul>
  </nav>
  <section>
    <p>以下の部門情報を削除します。</p>
    <p>情報を入力し、更新ボタンをクリックしてください。</p>
    <form action="./deptDelete.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号</th>
          <td>
              <?php echo $dept->getDeptno() ?>
            <input id="deleteDeptDeptno" type="hidden" name="deleteDeptDeptno"
                   value="<?php echo $dept->getDeptno() ?>">
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
        <tr>
          <td class="submit" colspan="2">
            <input type="submit" value="削除">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
