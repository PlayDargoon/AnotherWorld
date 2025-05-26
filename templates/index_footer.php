<?php
// В самом начале вашего скрипта (например, в index.php)
$loadStart = microtime(true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <style>
        .b-mt-footer {
            text-align: center;
        }
        .mb10 {
            margin-bottom: 10px;
        }
        .minor {
            color: grey;
        }
        
        .mt-footer-inner {
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Верхний блок футера с ссылками -->
<div class="b-mt-footer">
    <div class="mb10">
        <a class="minor" ignorewebview="true" target="_blank" href="#">Лицензионное соглашение</a>
        <a class="minor" ignorewebview="true" target="_blank" href="#">Политика конфиденциальности</a>
    </div>
    <div class="mb10">
        <a class="warn" href="#">Помощь</a>
        <a class="minor" ignorewebview="true" href="#">Поддержка</a>
    </div>
</div>

<!-- Нижний блок футера с автором и метриками -->
<div class="mt-footer-inner minor">
    <div>
        <span>Игра "Иной Мир" © 2025, <span class="minor">PlayDragon</span></span>
        12+
    </div>

   <!-- Текущие дата и время в Сахалинской области -->
<?php
date_default_timezone_set('Asia/Sakhalin');
echo '' . date('H:i') . ',  ' . date('d.m.Y') . '<br>';
?>

    <!-- Измерение скорости загрузки страницы -->
    <?php
    $loadEnd = microtime(true);
    $loadingTimeSeconds = number_format(($loadEnd - $loadStart), 3, ',', '');
    echo '| ' . $loadingTimeSeconds . ' сек<br>';
    ?>
</div>

</body>
</html>