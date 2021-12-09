<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Energos</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/main.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster" />
  <script src="../../js/jquerry.js"></script>
</head>
<body>
  <!-- <div class="wrapper">
      <img id="slide" src="images/slider.png" />
  </div> -->
  <div class="header">
    <img id="logo" src="../../images/plastic-bottle.png" alt="">
    <span id="SiteName">Energos</span>
    <div class="right-title">
      <a href="/register">Регистрация</a>
      <a href="/login">Войти</a>
      <a href="/cart">Корзина</a>
    </div>
  </div>
  <?php include 'application/views/'.$content_view; ?>
  <div class="footer">
    <div class="authors">
      <a href="https://vk.com/alexresh52">@Alexandr Alexeev</a>
      <a href="https://vk.com/capybara1620" class="authors">@Dmitriy Sharonov</a>
    </div>
  </div>
  

  <script src="../../js/main.js"></script>
</body>

</html>
