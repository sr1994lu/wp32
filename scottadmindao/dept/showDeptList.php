<?php
/**
 * WP32 07/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

$deptList = [];
try {
    $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
    $deptDAO = new DeptDAO($db);
    $deptList = $deptDAO->findAll();
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
  <title>部門情報追加 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
</head>
<body>
  <h1>部門情報追加</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php"></a>
      </li>
      <li>部門情報追加</li>
    </ul>
  </nav>
  <section>
    <p>新規登録は<a href="./goDeptAdd.php">こちら</a>から</p>
  </section>
  <section>
    <table>
      <thead>
      <tr>
        <th>部門番号</th>
        <th>部門名</th>
        <th>所在地</th>
        <th colspan="2">操作</th>
      </tr>
      </thead>
      <tbody>
      <?php
      if (empty($deptList)) {
          ?>
        <tr>
          <td colspan="5">該当部門は存在しません。</td>
        </tr>
          <?php

      } else {
          foreach ($deptList as $dept) {
              ?>
            <tr>
              <td><?php echo $dept->getDeptno() ?></td>
              <td><?php echo $dept->getDname() ?></td>
              <td><?php echo $dept->getLoc() ?></td>
              <td>
                <form action="./prepareDeptEdit.php" method="post">
                  <input id="editDeptDeptno" type="hidden" name="editDeptDeptno"
                         value="<?php echo $dept->getDeptno() ?>">
                  <input type="submit" value="編集">
                </form>
              </td>
              <td>
                <form action="./connfirmDeptDelete.php" method="post">
                  <input id="deleteDeptDeptno" type="hidden"
                         name="deleteDeptDeptno"
                         value="<?php echo $dept->getDeptno() ?>">
                  <input type="submit" value="削除">
                </form>
              </td>
            </tr>
              <?php

          }
      }
      ?>
      </tbody>
    </table>
  </section>
</body>
</html>
