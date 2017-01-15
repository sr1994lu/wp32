<?php
/**
 * WP32 02/13.
 */
$errorMsg = 'もう一度始めから操作をお願いします。';
if (isset($_SESSION['errorMsg'])) {
    $errorMsg = $_SESSION['errorMsg'];
}

session_unset();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Error | ScottAdmin Sample</title>
</head>
<body>
  <h1>Error</h1>
  <section>
    <h2>申し訳ございません。障害が発生しました。</h2>
    <p>以下のメッセージをご確認ください。</p>
    <p>
        <?php echo $errorMsg ?>
    </p>
  </section>
  <a href="./index.php">TOPへ戻る</a>
</body>
</html>
