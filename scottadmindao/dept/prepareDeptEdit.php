<?php
/**
 * WP32 10/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/dao/DeptDAO.class.php';

$dept = new Dept();
$validationMsgs = null;

if (isset($_POST['editDeptDeptno'])) {
    $editDeptDeptno = $_POST['editDeptDeptno'];
    try {
        $db = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $deptDAO = new DeptDAO($db);
        $dept = $deptDAO->findByPK($editDeptDeptno);
    } catch (PDOException $e) {
        print_r($e);
        $_SESSION['errorMsg'] = 'DB接続に失敗しました。';
    } finally {
        $db = null;
    }
} else {
    if (isset($_SESSION['dept'])) {
        $dept = $_SESSION[$validationMsgs];
        $dept = unserialize($dept);
    }
    if (isset($_SESSION['validationMsgs'])) {
        $validationMsgs = $_SESSION['validationMsgs'];
    }

    session_unset();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報編集 | ScottAdminDAO Sample</title>
  <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
</head>
<body>
  <h1>部門情報編集</h1>
  <nav>
    <ul>
      <li><a href="../index.php">TOP</a></li>
      <li>
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報編集</li>
    </ul>
  </nav>
    <?php
    if (!is_null($validationMsgs)) {
        ?>
      <section id="errorMsg">
        <p>以下のメッセージをご確認ください。</p>
        <ul>
            <?php
            foreach ($validationMsgs as $msg) {
                ?>
              <li>
                  <?php echo $msg ?>
              </li>
                <?php

            } ?>
        </ul>
      </section>
        <?php

    }
    ?>
  <section>
    <p>情報を入力し、更新ボタンをクリックしてください。</p>
    <form action="./deptEdit.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号</th>
          <td>
              <?php echo $dept->getDeptno() ?>
            <input id="editDeptDeptno" type="hidden" name="editDeptDeptno" value="<?php echo $dept->getDeptno() ?>">
          </td>
        </tr>
        <tr>
          <th>部門名</th>
          <td>
            <input id="editDeptDname" type="text" name="editDeptDname" value="<?php echo $dept->getDname() ?>">
          </td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>
            <input id="editDeptLoc" type="text" name="editDeptLoc" value="<?php echo $dept->getLoc() ?>">
          </td>
        </tr>
        <tr>
          <td class="submit" colspan="2">
            <input type="submit" value="更新">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
