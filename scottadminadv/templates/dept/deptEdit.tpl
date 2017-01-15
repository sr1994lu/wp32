<!doctype html>
<!--
{**
 * @src 17/18
 *}
-->
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>部門情報編集 | ScottAdminMVC Sample</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminadv/css/main.css">
</head>
<body>
  <h1>部門情報編集</h1>
  <nav>
    <ul>
      <li>
        <a href="/oh/wp32/scottadminadv/">TOP</a>
      </li>
      <li>
        <a href="/oh/wp32/scottadminadv/dept/showDeptList.php">部門リスト</a>
      </li>
      <li>
        部門情報編集
      </li>
    </ul>
  </nav>
  {if isset($validationMsgs)}
    <section id="errorMsg">
      <p>以下のメッセージをご確認ください。</p>
      <ul>
        {foreach from=$validationMsgs item="msg" name="validationMsgsLoop"}
          <li>{$msg}</li>
        {/foreach}
      </ul>
    </section>
  {/if}
  <section>
    <p>情報を入力し、更新ボタンをクリックしてください。</p>
    <form action="/oh/wp32/scottadminadv/dept/deptEdit.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号</th>
          <td>
            {$dept->getDeptno()}
            <input type="hidden" title="" id="editDeptDeptno" name="editDeptDeptno" value="{$dept->getDeptno()}">
          </td>
        </tr>
        <tr>
          <th>部門名&nbsp;<span class="required">必須</span></th>
          <td>
            <input type="text" title="" id="editDeptDname" name="editDeptDname" value="{$dept->getDname()}">
          </td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>
            <input type="text" title="" id="editDeptLoc" name="editDeptLoc" value="{$dept->getLoc()}">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="submit">
            <input type="submit" value="更新">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
