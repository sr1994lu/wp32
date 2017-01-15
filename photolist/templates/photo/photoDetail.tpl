<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>写真詳細 | 写真管理</title>
</head>
<body>
  <header>
    <h1>写真詳細</h1>
  </header>

  <nav>
    <ul>
      <li><a href="/oh/wp32/photolist/photo/showPhotoList.php">写真リスト</a></li>
      <li>写真詳細</li>
    </ul>
  </nav>

  <section>
    <h1>{$photo->getPhTitle()}</h1>
    <img src="{$upDir}{$photo->getPhPathLarge()}" alt="{$photo->getPhTitle()}">
    <p>{$photo->getPhNote()}</p>
  </section>
</body>
</html>
