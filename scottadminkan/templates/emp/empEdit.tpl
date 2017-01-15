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
  <title>部門情報編集 | scottadminkan Sample</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminkan/css/main.css">
</head>
<body>
  <p>ログインユーザー: {$loginName}さん</p>
  <h1>部門情報編集</h1>

  <nav>
    <ul>
      <li><a href="/oh/wp32/scottadminkan/">TOP</a></li>
      <li><a href="/oh/wp32/scottadminkan/emp/showEmpList.php">部門リスト</a></li>
      <li>部門情報編集</li>
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

    <form action="/oh/wp32/scottadminkan/emp/empEdit.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>部門番号</th>
          <td>
            {$emp->getEmpno()}
            <input type="hidden" id="editEmpEmpno" name="editEmpEmpno" value="{$emp->getEmpno()}">
          </td>
        </tr>
        <tr>
          <th>従業員名&nbsp;<span class="required">必須</span></th>
          <td>
            <input type="text" id="editEmpEname" name="editEmpEname" value="{$emp->getEname()}">
          </td>
        </tr>
        <tr>
          <th>役職&nbsp;<span class="required">必須</span></th>
          <td>
            <input type="text" id="editEmpJob" name="editEmpJob" value="{$emp->getJob()}">
          </td>
        </tr>
        <tr>
          <th>上司番号&nbsp;<span class="required">必須</span></th>
          <td>
            <select id="editEmpMgr" name="editEmpMgr">
              {if is_null($emp->getMgr())||$emp->getMgr()=='0'}
                <option value="0" selected>上司なし</option>
                {foreach from=$mgrList item="empMGR" name="mgrListLoop"}
                  {if !is_null($empMGR->getMgr())}
                    <option value="{$empMGR->getMgr()}">{$empMGR->getMgr()}</option>
                  {/if}
                {/foreach}
              {else}
                <option value="0">上司なし</option>
                {foreach from=$mgrList item="empMGR" name="empMgrListLoop"}
                  {if $emp->getMgr()==$empMGR->getMgr()}
                    {if !is_null($empMGR->getMgr())}
                      <option value="{$empMGR->getMgr()}" selected>
                        {$empMGR->getMgr()}
                      </option>
                    {/if}
                  {else}
                    {if !is_null($empMGR->getMgr())}
                      <option value="{$empMGR->getMgr()}">{$empMGR->getMgr()}</option>
                    {/if}
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
          <th>給与
          <td>
            <input type="text" title="" id="editEmpSal" name="editEmpSal" value="{$emp->getSal()}">
          </td>
        </tr>
        <tr>
          <th>歩合
          <td>
            <input type="text" title="" id="editEmpComm" name="editEmpComm" value="{$emp->getComm()}">
          </td>
        </tr>
        <tr>
          <th>部門番号&nbsp;<span class="required">必須</span></th>
          <td>
            <select id="editEmpDeptno" name="editEmpDeptno" title="">
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
            <input type="submit" value="更新">
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
