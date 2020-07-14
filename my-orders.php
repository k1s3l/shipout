<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>ship_out</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="my-orders.css">
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
        <div class="my-ship">
        <div class="my-orders">Мои посылки</div>
        <div class="orders">
        <div class="order-code">Код посылки</div>
        <div class="order-code">Код посылки</div>
        <div class="order-code">Код посылки</div>
        </div>
        </div>
        <div class="my-chat">
          <div class="chat-name">Мои чаты</div>
          <div class="chats">
            <?php
            include 'check.php';
            $loginCookie = $_SESSION['login'];
            $stmtPDO = $pdo->prepare('SELECT DISTINCT chat_id FROM chatMessage WHERE login = ?');
            $stmtPDO->bindParam(1, $loginCookie);
            $stmtPDO->execute();
            foreach($stmtPDO as $key){
              $keyChatID = $key['chat_id'];
              echo "<div class=\"chat-url\"><a href=\"https://shipout.ru/order$keyChatID\">https://shipout.ru/order$keyChatID</a></div>";
            }
             ?>
              </div>
        </div>
