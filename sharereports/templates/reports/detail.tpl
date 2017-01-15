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
    <table>
      <thead>
      <tr>
        <th>レポートID</th>
        <th>報告者:メールアドレス</th>
        <th>作業日</th>
        <th>作業開始時間</th>
        <th>作業終了時間</th>
        <th>作業種類名</th>
        <th>作業内容</th>
        <th>レポート登録日時</th>
        <th colspan="2">操作</th>
      </tr>
      </thead>
      <tbody>
        <tr>
          <td>{$reports->getId()}</td>
          <td>{$reports->getUsName()}:{$reports->getUsMail()}</td>
          <td>{$reports->getRpDate()|date_format:"%Y月%m月%d日"}</td>
          <td>{$reports->getRpTimeFrom()}</td>
          <td>{$reports->getRpTimeTo()}</td>
          <td>{$reports->getRcName()}</td>
          <td>{$reports->getRpContent()|truncate:10:'...'}</td>
          <td>{$reports->getRpCreatedAt()}</td>
          <td>
            <form action="/oh/wp32/sharereports/reports/prepareEmpEdit.php" method="post">
              <input type="hidden" id="editReportId" name="editReportId" value="{$reports->getId()}">
              <input type="submit" value="編集">
            </form>
          </td>
          <td>
            <form action="/oh/wp32/scottadminkan/emp/connfirmEmpDelete.php" method="post">
              <input type="hidden" id="deleteReportId" name="deleteReportId" value="{$reports->getId()}">
              <input type="submit" value="削除">
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</body>
</html>
