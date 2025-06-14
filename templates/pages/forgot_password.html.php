<!-- templates/pages/forgot_password.html.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
</head>

<body id="body_id" ignorewebview="true">
<div class="touch-influenced block-border">

    <div class="body">
        <h2>Восстановление пароля</h2>
        <div style="text-align:center;" class="p2">
            <img src="/images/rasporyaditel_310.jpg" width="310" height="103">
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/forgot_password" method="POST">
            <label for="email" class="green">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <button type="submit">Отправить</button>
        </form>
    </div>

    <div class="footer nav block-border-top">
        <ol>
            <li>
                <img class="i12img" src="/images/icons/home.png" alt="." width="12px" height="12px"> <a href="/">На главную</a>
            </li>
            <li>
                <img class="i12img" src="/images/icons/question_blue.png" alt="." width="12px" height="12px"> <a href="#">Первая помощь</a>
            </li>
        </ol>
    </div>

</div>

</body>
</html>
