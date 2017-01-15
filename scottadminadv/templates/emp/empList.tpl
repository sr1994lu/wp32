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
  <link rel="stylesheet" href="/oh/wp32/scottadminadv/css/main.css">
</head>
<body>
  <h1>部門情報リスト</h1>

  <nav>
    <ul>
      <li><a href="/oh/wp32/scottadminadv/">TOP</a></li>
      <li>部門情報リスト</li>
    </ul>
  </nav>

  {if isset($flashMsg)}
    <section>
      <p>{$flashMsg}</p>
    </section>
  {/if}

  <section>
    <p>新規登録は<a href="/oh/wp32/scottadminadv/emp/goEmpAdd.php">こちら</a>から</p>
  </section>

  <section>
    <table>
      <thead>
      <tr>
        <th>従業員番号</th>
        <th>従業員名</th>
        <th>役職</th>
        <th>上司</th>
        <th>雇用日</th>
        <th>給与</th>
        <th>歩合</th>
        <th>所属部門</th>
        <th colspan="2">操作</th>
      </tr>
      </thead>
      <tbody>
      {foreach from=$empList item='emp' name='empListLoop'}
        <tr>
          <td>{$emp->getEmpno()}</td>
          <td>{$emp->getEname()}</td>
          <td>{$emp->getJob()}</td>
          <td>
            {if $emp->getMgr() != null || $emp->getMgr() != 0}
              {$emp->getMgr()}:{$emp->getEname()}
            {else}
              上司なし
            {/if}
          </td>
          <td>{$emp->getHiredate()}</td>
          <td>{$emp->getSal()}</td>
          <td>{$emp->getComm()}</td>
          <td>
            {$emp->getDeptno()}:

            {foreach from=$deptList item='dept' name='deptListLoop'}
              {if $dept->getDeptno()==$emp->getDeptno()}
                {$dept->getDname($emp->getDeptno())}
              {/if}
            {/foreach}
          </td>
          <td>
            <form action="/oh/wp32/scottadminadv/emp/prepareEmpEdit.php" method="post">
              <input type="hidden" id="editEmpEmpno" name="editEmpEmpno" value="{$emp->getEmpno()}">
              <input type="submit" value="編集">
            </form>
          </td>
          <td>
            <form action="/oh/wp32/scottadminadv/emp/connfirmEmpDelete.php" method="post">
              <input type="hidden" id="deleteEmpEmpno" name="deleteEmpEmpno" value="{$emp->getEmpno()}">
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
