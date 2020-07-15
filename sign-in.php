<?php
  session_start();
  if (isset($_SESSION['login']) || (!empty($_SESSION['login']))) {
    header('Location: my-account');
  }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>FreeShip</title>
    <link rel="stylesheet" type="text/css" href="sign-in.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://hcaptcha.com/1/api.js?hl=ru" async defer></script>
  </head>
    <div id="header"><a href="/"><img src="/img/logo.png" alt="logo"></a></div>
  <body>
    <form method="post">
    <div class="password-login">
      <div class="login" style="display: flex;"><input type="login" required placeholder="login" id="login" name="login">
        <?php

          include 'check.php';
          $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
          $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
          $password = hash('sha256', $password);
          $stmtPDO = $pdo->prepare('SELECT * FROM data WHERE password = :password');
          $stmtPDO->bindParam(':password', $password);
          $stmtPDO->execute();
          $data = $stmtPDO->fetchAll(PDO::FETCH_ASSOC);
          foreach ($data as $rowData) {
            $rowLogin = $rowData['login'];
            $rowPass = $rowData['password'];
          }

  #if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response']))
  #{
  #      $secret = '0xEdb51e1beF57962367365961c5318779ea8A54E4';
  #      $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
  #      $responseData = json_decode($verifyResponse);
  #      if($responseData->success)
  #      {
if (isset($_POST['submit'])) {
            if(empty($_POST['login']) || empty($_POST['password'])){
              echo "<div class='already-taken'>Заполните поля</div>";
            }else{
    if (empty($rowLogin) || empty($rowPass)) {
      echo "<div class='already-taken'>Неверные имя пользователя/пароль</div>";
    }
    else {
      include 'userData.php';
      $stmtPDOquery = $pdo->prepare('SELECT first_name FROM users WHERE id = (SELECT id FROM data WHERE login = :login)');
      $stmtPDOquery->bindParam(':login', $login);
      $stmtPDOquery->execute();
      $data = $stmtPDOquery->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $row) {
        $first_name = $row['first_name'];
      }
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['fname'] = $first_name;
        header('Location: /');
         }
       }
     }
   #}
  #      else
  #      {
  #          echo "<div class='already-taken'>Captcha not valid</div>";
  #      }
  # }


?>
      </div>
        <div class="password"><input type="password" required placeholder="password" id="password" name="password"></div>
          <div class="auth"><div class="submit"><input type="submit" id="sign-in" value="Sign in" name="submit"></div>
	<div class="h-captcha" data-sitekey="0df7d0f7-8713-4aca-bb7e-dd33d36424c8" data-theme="light" data-error-callback="onError" ></div>
          <div class="additional">
            <div class="first-reg"><a href="/registration">Регистрация</a></div>
          </div>
      </div>
    </form>
  </body>
</html>
