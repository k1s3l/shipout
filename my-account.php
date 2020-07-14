<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
   if (isset($_POST['submit'])) {
    session_unset();
    session_destroy();
    setcookie('cookie');
    header("Location: /");
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="my-account.css">
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
        <div class="account-pic"><?php preg_match('/^./u', urldecode($_SESSION['fname']), $firstname); preg_match('/^./u', urldecode($_SESSION['lname']), $lastname); echo $firstname[0] . $lastname[0]; ?></div>
          <div class="setting">
        <div class="my-orders"><a href="/my-orders">Мои посылки</a></div>
        <div class="change-password"><a href="/change-pass">Изменить пароль</a></div>
        <div class="logout"><form method="post"><input type="submit" value="Выйти" name="submit">
      </form></div>
          </div>
        </div>
      </main>
      <footer class="contentinfo">
        <div class="copyright"><span class="copy">&copy; 2020 ship_out </span><span class="rules"><a href="/help">Конфиденциальность и cookie-файлы</a> / <a href="/help">Правила и условия</a></span></div>
     </footer>
</body>
</html>
