<!DOCTYPE html>
<html>
  <head>
    <title><?=$title?>></title>
      <meta charset="utf-8">
    <link rel="stylesheet" href="/css/styles.css">
    <script type="text/javascript" src="/JS/jquery.js"></script>
    <script type="text/javascript" src="/JS/sender.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <div class="slide">
        <div><img src="/img/banner.jpg" alt="реклама"></div>
        <div><img src="/img/banner.jpg" alt="реклама"></div>
        <div><img src="/img/banner.jpg" alt="реклама"></div>
      </div>
      <div class="content">
        <div class="menu">
          <a href="/">Получить бонус</a>
          <a href="/loto">заработать больше</a>
        <? if ($_SESSION['id']): ?>
          <a href="/profile">Профиль</a>
          <a href="logout">Выйти</a>
        <? else : ?>
          <a href="login">Вход</a>
          <a href="register">Регистрация</a>
        <? endif; ?>
        </div>
