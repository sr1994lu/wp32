<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>レポートリスト | Share Reports</title>
  <link rel="stylesheet" href="/oh/wp32/scottadminkan/css/main.css">
</head>
<body>
  <p>ログインユーザー: {$loginName}さん</p>
  <h1>レポートリスト</h1>

  <nav>
    <ul>
      <li><a href="/oh/wp32/sharereports/">TOP</a></li>
      <li>レポートリスト</li>
    </ul>
  </nav>

  {if isset($flashMsg)}
    <section>
      <p>{$flashMsg}</p>
    </section>
  {/if}

  <section>
    <p>新規登録は<a href="/oh/wp32/sharereports/goAdd.php">こちら</a>から</p>
    <p>全部で{$rowCount}件あります。</p>
  </section>

  <section>
    {if ($pageNo == 1)}
      &lt;&lt;最初へ&lt;前へ
    {else}
      {$prevPageNo = $pageNo - 1}
      <a href="/oh/wp32/sharereports/reports/showList.php?page=1">
        &lt;&lt;最初へ</a>
      &nbsp;
      <a href="/oh/wp32/sharereports/reports/showList.php?page={$prevPageNo}">{$prevPageNo}&let;前へ</a>
      &nbsp;
    {/if}

    {section name="pages" start="1" loop=$totalPage}
      {if ($smarty.section.pages.index == $pageNo)}
        {$smarty.section.pages.index}&nbsp;
      {else}
        <a href="/oh/wp32/sharereports/reports/showList.php?page={$smarty.section.pages.index}">{$smarty.section.pages.index}</a>
        &nbsp;
      {/if}
      {if ($smarty.section.pages.index != $totalPage)}
        |&nbsp;
      {/if}
      {if ($pageNo == $totalPage)}
        次へ&gt;
        最後へ&gt;&gt;
      {else}
        <a href="/oh/wp32/sharereports/reports/showList.php?page={$nextPageNo}">次へ&gt;</a>
        &nbsp;
        <a href="/oh/wp32/sharereports/reports/showList.php?page={$totalPage}">最後へ&gt;&gt;</a>
      {/if}
    {/section}
  </section>

  <section>
    <table>
      <thead>
      <tr>
        <th>作業日</th>
        <th>作業内容</th>
        <th>報告社名</th>
        <th colspan="1">操作</th>
      </tr>
      </thead>
      <tbody>
      {foreach $reportList as $reports}
        <tr>
          <td>{$reports->getRpDate()|date_format:"%Y月%m月%d日"}</td>
          <td>{$reports->getRpContent()}</td>
          <td>{$reports->getUsName()}</td>
          <td>
            <form action="/oh/wp32/sharereports/reports/showDetail.php" method="post">
              <input type="hidden" id="detailReportId" name="detailReportId" value="{$reports->getId()}">
              <input type="submit" value="詳細">
            </form>
          </td>
        </tr>
        {foreachelse}
        <tr>
          <td colspan="5">該当レポートは存在しません。</td>
        </tr>
      {/foreach}
      </tbody>
    </table>
  </section>
</body>
</html>
