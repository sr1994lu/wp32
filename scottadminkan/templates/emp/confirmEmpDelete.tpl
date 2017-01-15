<!doctype html>
<!--
{**
 * @src 18/18
 *}
-->
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報削除 | scottadminkan Sample</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminkan/css/main.css">
</head>
<body>
  <p>ログインユーザー: {$loginName}さん</p>
  <h1>部門情報削除</h1>

  <nav>
    <ul>
      <li><a href="/oh/wp32/scottadminkan/">TOP</a></li>
      <li><a href="/oh/wp32/scottadminkan/emp/showEmpList.php">部門リスト</a></li>
      <li>部門情報削除確認</li>
    </ul>
  </nav>

  <section>
    <p>以下の部門情報を削除します。<br>
      よろしければ、削除ボタンをクリックしてください。</p>

    <form action="/oh/wp32/scottadminkan/emp/empDelete.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号</th>
          <td>
            {$emp->getEmpno()}
            <input type="hidden" id="deleteEmpEmpno" name="deleteEmpEmpno" value="{$emp->getEmpno()}">
          </td>
        </tr>
        <tr>
          <th>部門名</th>
          <td>
            {$emp->getDname()}
          </td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>
            {$emp->getLoc()}
          </td>
        </tr>
        <tr>
          <td colspan="2" class="submit"><input type="submit" value="削除"></td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
