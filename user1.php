<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}

  $url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
$curl = preg_match_all('/[0-9]/', $url, $arr);
foreach($arr[0] as $num) {
  $nums = $nums . $num;
}
include "check.php";
$stmtPDO = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmtPDO->bindParam(1, $nums);
$stmtPDO->execute();
$data = $stmtPDO->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $key){
  $firstName = $key['first_name'];
  $lastName = $key['last_name'];
  $middleName = $key['middle_name'];
  $city = $key['city'];
  $vk = $key['vk'];
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="user1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
  <header class="banner">
    <div class="nav">
      <div class="logo-left">
        <div class="logo"><a href="/"><img src="../img/logo.png" alt="logo"></a></div>
          <div class="logo2"><a href="/">Freeship</a></div>
          </div>
          <div class="logo-center"><img src="/img/border-3.png"></div>
        </div>
      </header>
      <main class="main">
          <div class="menu">
        <div class="account-pic">Фото</div>
          <div class="setting">
        <div class="my-data"><?php echo $lastName . " " . $firstName . " " . $middleName ?></div>
        <div class="city"><?php echo $city ?></div>
        <div class="vk"><?php echo 'https://vk.com/' . $vk ?></div>
          </div>
        </div>
      </main>
      <footer class="contentinfo">
        <div class="copyright"><span class="copy">&copy; 2020 ship_out </span><span class="rules"><a href="/">Конфиденциальность и cookie-файлы</a> / <a href="/">Правила и условия</a></span></div>
      </footer>
</body>
</html>
