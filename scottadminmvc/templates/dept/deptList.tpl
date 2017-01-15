<!doctype html>
<!--
{**
 * @src 15/18
 *}
-->
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報リスト | ScottAdminMVC Sample</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminmvc/css/main.css">
</head>
<body>
  <h1>部門情報リスト</h1>
  <nav>
    <ul>
      <li>
        <a href="/oh/wp32/scottadminmvc/">TOP</a>
      </li>
      <li>
        部門情報リスト
      </li>
    </ul>
  </nav>
  {if isset($flashMsg)}
    <section>
      <p>{$flashMsg}</p>
    </section>
  {/if}
  <section>
    <p>新規登録は<a href="/oh/wp32/scottadminmvc/dept/goDeptAdd.php">こちら</a>から</p>
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
      {foreach from=$deptList item='dept' name='deptListLoop'}
        <tr>
          <td>{$dept->getDeptno()}</td>
          <td>{$dept->getDname()}</td>
          <td>{$dept->getLoc()}</td>
          <td>
            <form action="/oh/wp32/scottadminmvc/dept/prepareDeptEdit.php" method="post">
              <input type="hidden" id="editDeptDeptno" name="editDeptDeptno" value="{$dept->getDeptno()}">
              <input type="submit" value="編集">
            </form>
          </td>
          <td>
            <form action="/oh/wp32/scottadminmvc/dept/connfirmDeptDelete.php" method="post">
              <input type="hidden" id="deleteDeptDeptno" name="deleteDeptDeptno" value="{$dept->getDeptno()}">
              <input type="submit" value="削除">
            </form>
          </td>
        </tr>
        {foreachelse}
        <tr>
          <td colspan="5">該当部門は存在しません。</td>
        </tr>
      {/foreach}
      </tbody>
    </table>
  </section>
</body>
</html>
