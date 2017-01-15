<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>写真リスト | 写真管理</title>
  <link rel="stylesheet" href="/oh/wp32/photolist/css/main.css" type="text/css">
</head>
<body>
  <header>
    <h1>写真リスト</h1>
  </header>

  <nav>
    <ul>
      <li>写真リスト</li>
    </ul>
  </nav>

  {if isset($flashMsg)}
    <section>
      <p>{$flashMsg}</p>
    </section>
  {/if}

  <section>
    <p>新規登録は<a href="/oh/wp32/photolist/photo/goPhotoAdd.php">こちら</a>から</p>
  </section>

  <section>
    <ul>
      {foreach from=$photoList item="photo" name="photoListLoop"}
        <li>
          <a href="/oh/wp32/photolist/photo/showPhotoDetail.php?id={$photo->getId()}">
            <img src="{$upDir}{$photo->getPhPathSmall()}" alt="{$photo->getPhTitle}">
            {$photo->getPhTitle()}
          </a>
        </li>
        {foreachelse}
        <li>現在表示する写真はありません。</li>
      {/foreach}
    </ul>
  </section>
</body>
</html>
