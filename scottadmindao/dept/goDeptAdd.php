<?php
/**
 * WP32 08/13.
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/wp32/scottadmindao/classes/entity/Dept.class.php';

$dept = new Dept();
if (isset($_SESSION['dept'])) {
    $dept = $_SESSION['dept'];
    $dept = unserialize($dept);
}

$validationMsgs = null;
if (isset($_SESSION['validationMsgs'])) {
    $validationMsgs = $_SESSION['validationMsgs'];
}

session_unset();
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
        <a href="./showDeptList.php">部門リスト</a>
      </li>
      <li>部門情報追加</li>
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
    <p>情報を入力し、登録ボタンをクリックしてください。</p>
    <form action="./deptAdd.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addDeptDeptno" type="text" name="addDeptDeptno" value="<?php $dept->getDeptno() ?>">
          </td>
        </tr>
        <tr>
          <th>部門名&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addDeptDname" type="text" name="addDeptDname" value="<?php $dept->getDname() ?>">
          </td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>
            <input id="addDeptLoc" type="text" name="addDeptLoc" value="<?php $dept->getLoc() ?>">
          </td>
        </tr>
        <tr>
          <td class="submit" colspan="2">
            <input type="submit" value="登録">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
