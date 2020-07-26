<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="shops.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <header class="banner">
    <div class="nav">
        <div class="logo"><a href="/"><img src="../img/logo.png" alt="logo" width="64px"></a></div>
          <div class="logo2"><a href="/">Freeship</a></div>
          <div class="border-logo"><img src="../img/border-3.png" width="256px"></div>
          </div>
        </header>
  <div class="shops-list">
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    $urlCity = preg_replace('/^./', '', $url);
    include 'check.php';
    $stmtPDO = $pdo->prepare('SELECT * FROM shops');
    $stmtPDO->execute();
      foreach($stmtPDO as $key) {
        $shop = $key['shop'];
        echo "<div class\=\"$shop\">" . "<a href=\"chats?shop=$shop&city=$urlCity
        \"><div class=\"row\"><img src=\"/img/$shop.png\"></div></a></div>";
      }
    ?>
    </div>
    <script defer async src="/js/theme.js"></script>
</body>
