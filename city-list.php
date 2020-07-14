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
    <link rel="stylesheet" type="text/css" href="city-list.css">
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
        <div class="menu">
	<form id="form" method="post">
        <div class="border-search"><input type="search" name="search"></div>
        <div class="border-search"><input type="submit" name="submit" value="Введите город"></div>
        </form>
        <?php
	if(isset($_POST['submit']) | !empty($_POST['submit'])){
	  $searchResult = $_POST['search'];
          include 'check.php';
          $stmtPDO = $pdo->prepare('SELECT * FROM city WHERE city_rus = ?');
          $stmtPDO->bindParam(1, $searchResult);
          $stmtPDO->execute();
          foreach ($stmtPDO as $key) {
            $cityTranslit = $key['city_translit'];
            $cityRus = $key['city_rus'];
            if($searchResult == $cityRus || $searchResult == $cityTranslit){
            echo  "<div class=\"user-party\"><a href=\"$cityTranslit\">" . $cityRus . '</a></div>';
          }
	}
      }
        ?>
          </div>
</body>
