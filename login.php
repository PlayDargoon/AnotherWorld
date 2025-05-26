<!-- login.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в игру</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
</head>
<body id="body_id" ignorewebview="true">
<div class="touch-influenced block-border">
<div class="body">
    <h2>Вход</h2>
    <div style="text-align:center;" class="p2">
<img src="/images/rasporyaditel_310.jpg" width="310" height="103">
    </div>

    <form action="/includes/functions/process_login.php" method="POST">
        <label for="username" class="green">Имя персонажа:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password" class="green">Пароль:</label><br>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit" class="headerButton mt5"  style="width: 100%; border-radius: 50px;"><a>Войти</a></button>
    </form>


<div class="smail pt">
    <img src="/images/icons/rasp.png" alt="*" style="float:left;margin-right:8px;" class="ic32" width="32" height="32">
    Есть аккаунт а одной из социальных сетей? Авторизуйся и управляй несколькими персонажами из своего личного кабинета.
    <div style="clear: both;"></div>
</div>
    
    
    <a href="register.php" class="img"><img src="images/download.png" alt=""></a><br><br>
     <div>
<a class="headerButton mt5" style="width: 100%; border-radius: 50px;" href="/reset_password.php"><img class="i12img" height="12" width="12" src="/images/icons/book_red.png">Забыли пароль?</a>
</div>

</br>

</div>
<div class="footer block-border-top">
<a href="/index.php">
<img src="/images/icons/home.png" class="link-icon">
<span>На главную</span>
</a>
</br>
<a href="#">
<img src="/images/icons/question_blue.png" class="link-icon">
<span>Первая помощь</span>
</a>
</div>

</div>

<?php
require_once 'templates/index_footer.php';
?>

</body>
</html>