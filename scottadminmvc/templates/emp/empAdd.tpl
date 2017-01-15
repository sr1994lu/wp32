<!doctype html>
<!--
{**
 * @src 16/18
 *}
-->
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>従業員情報追加 | ScottAdminMVC Sample</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminmvc/css/main.css">
</head>
<body>
  <h1>従業員情報追加</h1>

  <nav>
    <ul>
      <li><a href="/oh/wp32/scottadminmvc/">TOP</a></li>
      <li><a href="/oh/wp32/scottadminmvc/emp/showEmpList.php">従業員リスト</a></li>
      <li>従業員情報追加</li>
    </ul>
  </nav>

  {if isset($validationMsgs)}
    <section>
      <p>以下のメッセージをご確認ください。</p>

      <ul>
        {foreach from=$validationMsgs item="msg" name="validationMsgsLoop"}
          <li>{$msg}</li>
        {/foreach}
      </ul>
    </section>
  {/if}

  <section>
    <p>情報を入力し、登録ボタンをクリックしてください。</p>

    <form action="/oh/wp32/scottadminmvc/emp/empAdd.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>従業員番号&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addEmpEmpno" type="text" name="addEmpEmpno" value="{$emp->getEmpno()}">
          </td>
        </tr>
        <tr>
          <th>従業員名&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addEmpEname" type="text" name="addEmpEname" value="{$emp->getEname()}">
          </td>
        </tr>
        <tr>
          <th>役職&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addEmpJob" type="text" name="addEmpJob" value="{$emp->getJob()}">
          </td>
        </tr>
        <tr>
          <th>上司番号&nbsp;<span class="required">必須</span></th>
          <td>
            <select id="addEmpMgr" name="addEmpMgr" title="">
              {if empty($emp->getMgr())&&!$emp->getMgr()=='0'}
                <option value="0">選択してください</option>
                <option value="0">上司なし</option>
                {foreach from=$mgrList item="empMGR" name="mgrListLoop"}
                  {if $empMGR->getMgr()!=null}
                    <option value="{$empMGR->getMgr()}">{$empMGR->getMgr()}</option>
                  {/if}
                {/foreach}
              {elseif $emp->getMgr()=='0'}
                <option value="0">選択してください</option>
                <option value="0" selected>上司なし</option>
                {foreach from=$mgrList item="empMGR" name="mgrListLoop"}
                  {if $empMGR->getMgr()!=null}
                    <option value="{$empMGR->getMgr()}">{$empMGR->getMgr()}</option>
                  {/if}
                {/foreach}
              {else}
                <option value="0">選択してください</option>
                <option value="0">上司なし</option>
                {foreach from=$mgrList item="empMGR" name="mgrListLoop"}
                  {if $empMGR->getMgr()!=null}
                    <option value="{$empMGR->getMgr()}">{$empMGR->getMgr()}</option>
                  {/if}
                {/foreach}
              {/if}
            </select>
          </td>
        </tr>
        <tr>
          <th>雇用日&nbsp;<span class="required">必須</span></th>
          <td>
            {html_select_date prefix='Hire' time="{$timeY}-{$timeM}-{$timeD}" start_year='1950' field_order='YMD' month_format='%m'}
          </td>
        </tr>
        <tr>
          <th>給与&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addEmpSal" type="text" name="addEmpSal" value="{$emp->getSal()}">
          </td>
        </tr>
        <tr>
          <th>歩合&nbsp;<span class="required">必須</span></th>
          <td>
            <input id="addEmpComm" type="text" name="addEmpComm" value="{$emp->getComm()}">
          </td>
        </tr>
        <tr>
          <th>部門番号&nbsp;<span class="required">必須</span></th>
          <td>
            <select id="addEmpDeptno" name="addEmpDeptno">
              {if empty($emp->getDeptno())}
                <option value="0">選択してください</option>
                {foreach from=$deptList item="dept" name="deptListLoop"}
                  {if !is_null($dept->getDeptno())}
                    <option value="{$dept->getDeptno()}">{$dept->getDeptno()}:{$dept->getDname()}</option>
                  {/if}
                {/foreach}
              {else}
                {foreach from=$deptList item="dept" name="deptListLoop"}
                  {if $emp->getDeptno()==$dept->getDeptno()}
                    <option value="{$dept->getDeptno()}" selected>{$dept->getDeptno()}:{$dept->getDname()}</option>
                  {else}
                    {if !is_null($dept->getDeptno())}
                      <option value="{$dept->getDeptno()}">{$dept->getDeptno()}:{$dept->getDname()}</option>
                    {/if}
                  {/if}
                {/foreach}
              {/if}
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="submit">
            <input type="submit" value="登録">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
