<?php
  if (!empty($_SESSION['login'])) {
    header('Location: sign-in');
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="registration.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://hcaptcha.com/1/api.js?hl=ru" async defer></script>
  </head>
  <header class="banner">
    <div class="nav">
        <div class="logo"><a href="/"><img src="../img/logo.png" alt="logo" width="64px"></a></div>
          <div class="logo2"><a href="/">Freeship</a></div>
          <div class="border-logo"><img src="../img/border-3.png" width="256px"></div>
          </div>
        </header>
  <body>
    <div class="user-data">
          <form method="post">
  <div class="email"><input type="email" required placeholder="E-Mail" name="email">
<?php
  include 'check.php';
  if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response']))
  {
        $secret = '0xEdb51e1beF57962367365961c5318779ea8A54E4';
        $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {

  if (isset($_POST['submit'])) {
   if(!isset($_POST['confirm']) && $_POST['confirm'] !== '1'){
     echo "<div class='already-taken'>Для завершения регистрации необходимо согласиться с политикой конфиденциальности</div>";
   }else {
    if(empty($_POST['email']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['middle_name']) || empty($_POST['city']) || empty($_POST['vk'])){
      echo "<div class='already-taken'>Неверное имя пользователя или пароль</div>";
    }else{
    $stmtPDO = $pdo->prepare('SELECT login FROM data WHERE login = :login');
    $stmtPDO->execute(array('login' => $login));
        foreach($stmtPDO as $row) {
        $rowLogin = $row['login'];
    	 	}
    $stmtPDO = $pdo->prepare('SELECT email FROM users WHERE email = ?');
    $stmtPDO->bindParam(1, $email);
    $stmtPDO->execute();
    $data = $stmtPDO->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
      $rowEmail = $row['email'];
    }
      if (!empty($rowLogin) || !empty($rowEmail)) {
        echo "<div class='already-taken'>Введите другой имя пользователя / Email</div>";
  }else{
      $preg = '/[a-zA-Z0-9а-яА-я]/';
      $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
      $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $password = hash('sha256', $password);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
      $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
      $middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);
      $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
      $vk = filter_var($_POST['vk'], FILTER_SANITIZE_STRING);
      if(trim(preg_replace($preg, '', $login)) !== '' || trim(preg_replace($preg, '', $first_name)) !== '' || trim(preg_replace($preg, '', $middle_name)) !== '' ||
       trim(preg_replace($preg, '', $last_name)) !== '' || trim(preg_replace($preg, '', $city)) !== '' || trim(preg_replace($preg, '', $vk)) !== '' ){
        echo "<div class='already-taken'>В полях кроме \"Пароль\" разрешены только буквы и цифры</div>";
      }else{
        if(strlen($login) < 5){
          echo "<div class='already-taken'>Минимальная длина логина 5 символов</div>";
        }else{
          include 'check.php';
          $stmtPDOquery = $pdo->prepare('INSERT INTO data (login, password) VALUES(:login, :password)');
          $stmtPDOquery->bindParam(':login', $login);
          $stmtPDOquery->bindParam(':password', $password);
          $stmtPDOquery->execute();
          $stmtPDOquery = $pdo->prepare('INSERT INTO users (email, first_name, last_name, middle_name, city, vk) VALUES(:email, :first_name, :last_name, :middle_name, :city, :vk)');
          $stmtPDOquery->bindParam(':email', $email);
          $stmtPDOquery->bindParam(':first_name', $first_name);
          $stmtPDOquery->bindParam(':last_name', $last_name);
          $stmtPDOquery->bindParam(':middle_name', $middle_name);
          $stmtPDOquery->bindParam(':city', $city);
          $stmtPDOquery->bindParam(':vk', $vk);
          $stmtPDOquery->execute();
          header("Location: /");
             }
            }
  	      }
      	}
      }
    }
  }
}



?>
</div>
   <div class="login"><input type="login" required placeholder="Логин" name="login"></div>
     <div class="password"><input type="password" required placeholder="Пароль" name="password"></div>
      <div class="first-name"><input type="text" required placeholder="Имя" name="first_name"></div>
        <div class="last-name"><input type="text" required placeholder="Фамилия" name="last_name"></div>
          <div class="middle-name"><input type="text" required placeholder="Отчество" name="middle_name"></div>
            <div class="city"><input type="text" required placeholder="Город" name="city"></div>
              <div class="vk"><input type="text" required placeholder="VK (Ваш ID)" name="vk"></div>
		<div class="confirm"><input type="checkbox" name="confirm" value="1"><a href="/help">С политикой ознакомлен и согласен</a></div>
		<div class="h-captcha" data-sitekey="0df7d0f7-8713-4aca-bb7e-dd33d36424c8" data-theme="light" data-error-callback="onError"></div>
      </div>
      <div class="auth"><div class="submit"><input type="submit" id="sign-in" value="Sign in" name="submit"></div></form>
      </body>
