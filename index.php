<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>FreeShip</title>
    <meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Rubik|Odibee+Sans|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
  <header class="banner">
    <div class="nav">
      <div class="logo-left">
          <div class="logo2"><a href="/">Freeship</a></div>
          </div>
    <div class="sign-help">
    <div class="sign-in" id="sign-in">
      <div class="sign-link">
      <a href="/sign-in"><?php if (isset($_SESSION['login']) | !empty($_SESSION['login'])) { echo $_SESSION['login'];} else {echo 'Sign in';}?></a>
    </div>
    </div>
  <div class="help"><a href="mailto:shipout88@yandex.ru">Help</a></div>
    </div>
  </div>
</header>
<main class="main">
  <div class="order-together"><div class="orders"><a href="/my-orders">My Orders</a></div>
  <div class="search_joint_order"><a href="/city-list">Order together</a></div></div>
  <div class="shop-partner">
<!-- admitad.banner: nxqkzls5cu5e1ea9c087a814938f71 SuperStep RU -->
<a target="_blank" rel="nofollow" href="https://ad.admitad.com/g/nxqkzls5cu5e1ea9c087a814938f71/?i=4"><img width="120" height="600" border="0" src="https://ad.admitad.com/b/nxqkzls5cu5e1ea9c087a814938f71/" alt="SuperStep RU"/></a>
<!-- /admitad.banner -->
  </div>
</main>
<footer class="contentinfo">
  <div class="copyright"><span class="copy">&copy; 2020 ship_out </span><span class="rules"><a href="/help">Конфиденциальность и cookie-файлы</a> / <a href="/help">Правила и условия</a></span></div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(65588731, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/65588731" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</footer>
</body>
</html>
