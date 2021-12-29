<?php
  if(isset($_SESSION["User"]) AND !empty($_SESSION["User"])){
    $user = $_SESSION["User"];
  }
?>
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
    <span id="SiteName" onClick="window.location.replace('http://energos/');">Energos</span>
    <div class="right-title">
      <?php
        if(isset($user)){
          echo '<a href="/login/logout">Выйти</a><a href="/cart">Корзина</a> ['.$user->firstName.']';
        }else{
          echo '<a href="/register">Регистрация</a>
          <a href="/login">Войти</a>';
        }
      ?>
      
    </div>
  </div>
  <?php include 'application/views/'.$content_view; ?>
  <div class="footer">
    <div class="authors">
      <a href="https://vk.com/alexresh52">@Alexandr Alexeev</a>
      <a href="https://vk.com/capybara1620" class="authors">@Dmitriy Sharonov</a>
      <?php if($_SESSION['User']->id == 1){
        echo '<a href="admin">Админ панель</a>';
		  }?>
    </div>
  </div>
  

  <script src="../../js/main.js"></script>
</body>

</html>
