<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>FreeShip</title>
    <link rel="stylesheet" type="text/css" href="change-pass.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
    <div id="header"><a href="/"><img src="/img/logo.png" alt="logo"></a></div>
  <body>
    <form action="" method="post">
    <div class="change-data">
      <div class="oldpass"><input type="password" placeholder="Your Password" id="oldpass" name="oldpass"></div>
        <div class="newpass"><input type="password" placeholder="New Password" id="password"></div>
        <div class="accept-pass"><input type="password" placeholder="Confirm new Password" id="new-pass" name="newpass"></div>
          <div class="submit"><input type="submit" id="sign-in" value="Sign in" name="submit"></div>
          <?php
          include 'check.php';
          $loginSession = $_SESSION['login'];
	      $newPassword = $_POST['newpass'];
   	      $newPassword = hash('sha256', $newPassword);
          $stmtPDO = $pdo->prepare('SELECT * FROM data WHERE login = ?');
          $stmtPDO->bindParam(1, $loginSession);
          $stmtPDO->execute();
          foreach ($stmtPDO as $key) {
            $keyPassword = $key['password'];
          }
          if(isset($_POST['submit'])){
            if($keyPassword == (hash('sha256', $_POST['oldpass']))){
              $stmtPDO = $pdo->prepare('UPDATE data SET password = ? WHERE login = ?');
              $stmtPDO->bindParam(1, $newPassword);
              $stmtPDO->bindParam(2, $loginSession);
	      $stmtPDO->execute();
              header("Location: /");
            }else{
              echo "<div class=\"unknown-password\">incorrect password</div>";
            }
          }
          ?>
      </div>
    </form>
  </body>
</html>
