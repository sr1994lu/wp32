<!doctype html>
<!--
{**
 * @src 14/25
 *}
-->
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TOP | ScottAdmin完 Sample</title>
</head>
<body>
  <header>
    <p>ログインユーザー: {$loginName}さん</p>
    <h1>TOP</h1>
    <p><a href="/oh/wp32/scottadminkan/logout.php">ログアウト</a></p>
  </header>

  <nav>
    <ul>
      <li><a href="/oh/wp32/scottadminkan/dept/showDeptList.php">部門リスト</a></li>
      <li><a href="/oh/wp32/scottadminkan/emp/showEmpList.php">従業員リスト</a></li>
    </ul>
  </nav>
</body>
</html>
