<!-- templates/layout.html.php -->
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Игра Иной Мир'; ?></title>
    <link rel="stylesheet" href="css/style.css"> <!-- Подключаем ваши стили -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
    <link rel="icon" href="/favicon.png" type="image/x-icon"> <!-- Подключаем фавикон -->
</head>

<body id="body_id" ignorewebview="true">

<div class="touch-influence block-border">

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <div class="header small block-border-bottom">
            <?php include 'partials/header.html.php'; ?> <!-- Шапка -->зз
        </div>
    <?php endif; ?>

    <?php include $contentFile; ?> <!-- Здесь отображается контент конкретной страницы -->

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <div class="footer block-border-top"></div>   <!-- специальный отступ  -->

        <?php include 'partials/logged_footer.html.php'; ?> <!-- Подключаем футер для залогиненных пользователей -->
    <?php endif; ?>
</div>

<div class="b-mt-footer">
    <?php include 'partials/footer.html.php'; ?>
</div>

</body>
</html>