<!-- Восстановление пароля -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в игру</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
</head>
<?php
$loadStart = microtime(true); // Начинаем замер времени
?>
<body id="body_id" ignorewebview="true">
<div class="touch-influenced block-border">
<div class="body">
    <h2>Забыли пароль?</h2></br>
    <span>Чтобы воостановить пароль, введите имя персонажа, и email указанный при регистрации. Если данные окажутся верными, то на указанный email будет отправлена ссылка для восстановления пароля.</span></b>
    
    <div class="small minor"></br>
Подсказка: если письма нет во входящих, посмотрите в папку "Спам" или "Нежелательная почта".
    </div>

    <form action="process_reset.php" method="POST">
        <label for="email"class="green">Email:</label><br>
        <input type="email" id="email" name="email" required>
        </br></br>
       <a class="headerButton mt5" style="width: 100%; border-radius: 50px;" href="#"><img class="i12img" height="12" width="12" src="/images/arr.png">Восстановить пароль</a>
    </form>
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