<div class = "admin">
<link rel="stylesheet" href="css/reglog.css">   
    <h3>Регистрация</h3>
    <h3 id="warn"></h3>
    <table cellspacing="5" cellpadding="5" >
    <tr>
      <td>Имя:</td>
      <td><input type="text" class="inputText" name="firstName"></td>
    </tr>
    <tr>
      <td>Фамилия:</td>
      <td><input type="text" class="inputText" name="lastName"></td>
    </tr>
    <tr>
      <td>Никнейм на сайте:</td>
      <td><input type="text" class="inputText" name="nickname"></td>
    </tr>
    <tr>
      <td>Пароль:</td>
      <td><input type="password" class="inputText" name="password"></td>
    </tr>
    <tr>
      <td>Повторите пароль:</td>
      <td><input type="password" class="inputText" name="confirmPassword"></td>
    </tr>
    <tr>
      <td>Место доставки:</td>
      <td><input type="text" class="inputText" name="location"></td>
    </tr>
    
</table>
<button handle="register">Зарегистрировать человека</button>
</div>
<div class="admin">
    <h3>Вход под любым пользователем</h3>
    <form action="/admin/login" method="post">
        <p>Никнейм: <input type="text" name="nickname"></p>
        <input type="submit" value="Войти">
    </form>
</div>
<script src="../../js/main.js"></script>