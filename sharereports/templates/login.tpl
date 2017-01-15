<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン | Share Reports</title>
</head>
<body>
  <h1>ログイン</h1>

  {if isset($validationMsgs)}
    <section id="errorMsg">
      <p>以下のメッセージをご確認ください</p>
      <ul>
        {foreach from="validationMsgs" item="msg" name="validationMsgsLoop"}
          <li>{$msg}</li>
        {/foreach}
      </ul>
    </section>
  {/if}

  <section>
    <p>IDとパスワードを入力し、ログインをクリックしてください。</p>

    <form action="/oh/wp32/sharereports/login.php" method="post">
      <table>
        <tbody>
        <tr>
          <th>メールアドレス</th>
          <td><input type="text" title="loginMail" id="loginMail" name="loginMail" value="{$loginMail|default:''}"></td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td><input type="password" title="loginPw" id="loginPw" name="loginPw"></td>
        </tr>
        <tr>
          <td colspan="2" class="submit"><input type="submit" value="ログイン"/></td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
