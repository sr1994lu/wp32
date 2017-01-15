<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>写真追加 | 写真管理</title>
</head>
<body>
  <header>
    <h1>写真追加</h1>
  </header>

  <nav>
    <ul>
      <li><a href="/oh/wp32/photolist/photo/showPhotoList.php">写真リスト</a></li>
      <li>写真追加</li>
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
    <p>情報を入力し、登録ボタンをクリックしてください。</p>
    <form action="/oh/wp32/photolist/photo/photoAdd.php" method="post" enctype="multipart/form-data">
      <table>
        <tbody>
        <tr>
          <th>タイトル&nbsp;<span class="required">必須</span></th>
          <td>
            <input type="text" id="addPhotoTitle" name="addPhotoTitle" value="{$photo->getPhTitle()|default:''}">
          </td>
        </tr>
        <tr>
          <th>写真&nbsp;<span class="required">必須</span></th>
          <td>
            <input type="file" id="addPhotoFile" name="addPhotoFile">
            <p>JPEG または PNG画像</p>
          </td>
        </tr>
        <tr>
          <th>備考</th>
          <td><textarea id="addPhotoNote" name="addPhotoNote">{$photo->getPhNote()|default:''}</textarea></td>
        </tr>
        <tr>
          <td colspan="2" class="submit"><input type="submit" value="登録"></td>
        </tr>
        </tbody>
      </table>
    </form>
  </section>
</body>
</html>
