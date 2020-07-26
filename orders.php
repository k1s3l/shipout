<?php
session_start();
if (!isset($_SESSION['login']) || (empty($_SESSION['login']))) {
  header('Location: sign-in');
}
  $url = $_SERVER['REQUEST_URI'];
  $url = explode('?', $url);
  $url = $url[0];
  $urlCity = preg_replace('/^.{6}/', '', $url);
  include 'check.php';
  $stmtPDO = $pdo->prepare('SELECT DISTINCT chat_id FROM chatInfo WHERE chat_id = ?');
  $stmtPDO->bindParam(1, $urlCity);
  $stmtPDO->execute();
  $data = $stmtPDO->fetchAll(PDO::FETCH_ASSOC);
  if(empty($data)){
    header("Location: /");
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="orders.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
  <script
        src="https://code.jquery.com/jquery-3.5.0.js"
        integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
        crossorigin="anonymous"></script>
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
      <?php
      include 'check.php';
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        $urlCity = preg_replace('/^.{6}/', '', $url);
        $stmtPDOquery = $pdo->prepare('SELECT DISTINCT login FROM chatMessage WHERE chat_id = ?');
        $stmtPDOquery->bindParam(1, $urlCity);
        $stmtPDOquery->execute();
        foreach($stmtPDOquery as $row) {
          $loginFirstName = $row['login'];
          $statementPDOquery = $pdo->prepare('SELECT id FROM data WHERE login = ?');
          $statementPDOquery->bindParam(1, $loginFirstName);
          $statementPDOquery->execute();
          foreach($statementPDOquery as $key) {
            $keyID = $key['id'];
            echo "<div class=\"user\"><a href=\"user$keyID\">" . $row['login'] . '</a></div>';
          }
        }

      ?>
      </div>
      <div class="tablet"><div class="messages"><div class="chat" id="chat">
        <?php
        include 'check.php';
          $url = $_SERVER['REQUEST_URI'];
          $url = explode('?', $url);
          $url = $url[0];
          $urlCity = preg_replace('/^....../', '', $url);
          $stmtPDOquery = $pdo->prepare('SELECT * FROM chatMessage WHERE chat_id = ?');
          $stmtPDOquery->bindParam(1, $urlCity);
          $stmtPDOquery->execute();
          foreach($stmtPDOquery as $row) {
            $loginFirstName = $row['login'];
            $statementPDOquery = $pdo->prepare('SELECT first_name FROM users WHERE id = (SELECT id FROM data WHERE login = (SELECT login FROM chatMessage WHERE login = ? LIMIT 1))');
            $statementPDOquery->bindParam(1, $loginFirstName);
            $statementPDOquery->execute();
            foreach ($statementPDOquery as $key) {
              $rowName = $key['first_name'];
            }
            echo "<div class=\"message\"><div class=\"textMessage\"><div class=\"username\">" . $rowName . "</div><div class=\"userText\">" . $row['message'] . "</div></div><div class=\"time\">" . preg_replace('/(^.{11})|(.{3}$)/', '', $row['posted_at']) . "</div></div>";
          }
        ?>
        </div>
        <div class="sendMessage" id="sendMessage">
          <form method="post">
          <input type="text" id="text" name="text" >
	   <button type="button" id="button">
	    </button>
          </form>
          </div>
  </div>
        <div class="right-button" id="right-buttons">
        <div class="exit-chat"><a href="/">Выйти из чата</a></div>
      </div>
    </div>
      </main>
              <script src="js/chat.js"></script>
              <script defer async src="/js/theme.js"></script>
    </body>
