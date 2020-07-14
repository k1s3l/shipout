<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
  include 'check.php';
  $arrShop = array();
  $arrCity = array();
  $inc = 0;
  $shopMatch = 0;
  $incCity = 0;
  $cityMatch = 0;
  $stmtPDO = $pdo->prepare('SELECT * FROM shops');
  $stmtPDO->execute();
  foreach ($stmtPDO as $key) {
    $arrShop[] = $key['shop'];
    $incShop++;
  }
  $stmtPDO = $pdo->prepare('SELECT * FROM city');
  $stmtPDO->execute();
  foreach ($stmtPDO as $key) {
    $arrCity[] = $key['city_translit'];
    $incCity++;
  }
    for($i=0; $i<$incShop; $i++){
      $shopKey = $arrShop[$i];
      if($shopKey == $_GET['shop']){
        $shopMatch++;
      }
    }
    for($i=0; $i<$incCity; $i++){
      $cityKey = $arrCity[$i];
      if($cityKey == $_GET['city']){
        $cityMatch++;
      }
    }
    if($shopMatch == 0 || $cityMatch == 0){
      header("Location: /");
    }


?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>ship_out</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="your-city.css">
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
        <div class="chat-setting">
          <div class="chat-border">
            <div id="create-chat">+</div>
          </div>
          <?php //GET-параметры должны соответствовать значениям массивов
          if(isset($_POST['submit'])){
            if( trim($_POST['text']) == ''){
      echo  "<form method=\"post\" id=\"form-chat\" style=\"display:flex\">" .
            '<div class="border-input"><input type="text" placeholder="Введите название чата" id="text" name="text"></div>
            <div class="border-input"><input type="submit" value="Создать чат" id="button" name="submit"></div>' . '</form></div><br><div class="warning" id="warning">Заполните поле</div>';
          }else{
            $text = $_POST['text'];
            include 'check.php';
            $stmtPDO = $pdo->prepare('SELECT chat_id FROM chatInfo ORDER BY chat_id DESC LIMIT 1');
            $stmtPDO->execute();
            foreach ($stmtPDO as $key) {
              $chatID = $key['chat_id'];
              $chatID = +$chatID;
              $chatID = $chatID + 1;
              $shop = $_GET['shop'];
              $city = $_GET['city'];
            }
            $stmtPDO = $pdo->prepare('INSERT INTO chatInfo (chat_id, name, shopOrders, city) VALUES(?, ?, ?, ?)');
            $stmtPDO->bindParam(1, $chatID);
            $stmtPDO->bindParam(2, $text);
            $stmtPDO->bindParam(3, $shop);
            $stmtPDO->bindParam(4, $city);
            $stmtPDO->execute();
            $url = 'order' . strval($chatID);
            header("Location: $url");
          }
        }else{
          echo "<form method=\"post\" id=\"form-chat\">" .
                '<div class="border-input"><input type="text" placeholder="Введите название чата" id="text" name="text"></div>
                <div class="border-input"><input type="submit" value="Создать чат" id="button" name="submit"></div></form></div>';
        }
            ?>


        <div class="menu">
          <?php
          include 'check.php';
          $shop = $_GET['shop'];
          $city = $_GET['city'];
          $stmtPDO = $pdo->prepare('SELECT * FROM chatInfo WHERE shopOrders = ? AND city = ?');
          $stmtPDO->bindParam(1, $shop);
          $stmtPDO->bindParam(2, $city);
          $stmtPDO->execute();
          foreach($stmtPDO as $key){
            $keyName = $key['name'];
            $keyChatId = $key['chat_id'];
            echo '<div class="user-party">' . "<a href=\"order$keyChatId\">" . $keyName . '</a></div>';
          }
          ?>
          <!-- <div class="user-party"><a href="orders">Нытик</a></div> -->
          </div>
          <script src="js/chat-rooms.js"></script>
</body>
