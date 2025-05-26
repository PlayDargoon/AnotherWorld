<!-- user.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о персонаже</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключаем jQuery -->
</head>
<?php
// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

// Получаем ID пользователя из URL
$userId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($userId === null) {
    die('Не указан ID пользователя.');
}

// Соединение с базой данных
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные пользователя по его ID
    $stmt = $pdo->prepare("SELECT health, vitality FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Пользователь не найден!');
    }

    // Обновляем значение vitality
    $newVitality = $userData['health'] * 10;
    if ($newVitality !== $userData['vitality']) {
        $stmt = $pdo->prepare("UPDATE users SET vitality = :vitality WHERE user_id = :user_id");
        $stmt->execute([':vitality' => $newVitality, ':user_id' => $userId]);
    }

    // Получаем обновленные данные пользователя
    $stmt = $pdo->prepare("SELECT username, character_class, gender, side, level, experience, health, damage, defense, vitality, user_id, last_activity, created_at, play_time FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Пользователь не найден!');
    }

    // Определяем путь к изображению пола
    $genderImagePath = $userData['gender'] === 'Male' ? 'sex_male.png' : 'sex_female.png';

    // Перевод значений на русский язык
    $sideTranslation = $userData['side'] === 'Light' ? 'Светлый' : 'Темный';
    $classTranslation = '';
    switch ($userData['character_class']) {
        case 'Warrior':
            $classTranslation = 'Воин';
            break;
        case 'Mage':
            $classTranslation = 'Маг';
            break;
        case 'Monk':
            $classTranslation = 'Монах';
            break;
    }

    // Форматируем значения
    $healthFormatted = number_format($userData['health'], 0, '.', ' ');
    $strengthFormatted = number_format($userData['damage'], 0, '.', ' ');
    $defenseFormatted = number_format($userData['defense'], 0, '.', ' ');
    $vitalityFormatted = number_format($userData['vitality'], 0, '.', ' ');

    // Проверяем статус онлайн
    $lastActivityTimestamp = strtotime($userData['last_activity']);
    $now = time();
    $onlineThreshold = 300; // Пользователь считается онлайн, если он был активен в последние 5 минут
    $isOnline = ($now - $lastActivityTimestamp) <= $onlineThreshold;

    // Определение текущей страницы
    switch ($_SERVER['REQUEST_URI']) {
        case '/templates/user.php':
            $pageTitle = 'Профиль персонажа';
            break;
        case '/templates/city.php':
            $pageTitle = 'Город';
            break;
        default:
            $pageTitle = 'Главная страница';
            break;
    }

    // Дата регистрации
    $registrationDate = date('d M Y', strtotime($userData['created_at']));

    // Преобразуем игровое время в понятный формат
    $playTimeInSeconds = isset($userData['play_time']) ? $userData['play_time'] : 0;
    $hours = floor($playTimeInSeconds / 3600);
    $minutes = floor(($playTimeInSeconds % 3600) / 60);
    $seconds = $playTimeInSeconds % 60;

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}
?>
<body>
<div class="touch-influenced block-border">
    <div class="body">
            <div class="small">
        <h2><?= htmlspecialchars($userData['username']); ?></h2>
            </div>
              <div class="small">
                  <span><?= htmlspecialchars($sideTranslation); ?></span> <span><?= htmlspecialchars($classTranslation); ?></span>, <span><?= $userData['level']; ?></span> <span> ур. </span>
                  <img src="/images/icons/<?php echo $genderImagePath; ?>" alt="<?= $userData['gender'] === 'Male' ? 'муж.' : 'жен.' ?>" width="12" height="12">
              </div>
    
        <!-- Ссылка на характеристики -->
        <div class="pb pt">
            <h2><a href="/templates/stats.php?id=<?php echo $userId; ?>">Характеристики</a></h2>
        </div>

        <!-- Отображение характеристик -->
        <ol class="mt3">
            <li>
                <img src="/images/icons/health.png" alt="." width="12" height="12" class="link-icon">
                <span class="minor">Живучесть:</span> <span id="health-value"><?= $userData['health']; ?></span> (<span id="vitality-value"><?= $vitalityFormatted; ?></span> здоровья)
            </li>
            <li>
                <img src="/images/icons/strength.png" alt="." width="12" height="12" class="link-icon">
                <span class="minor">Сила:</span> <span><?= $userData['damage']; ?></span> (удар ~<span><?= $strengthFormatted; ?></span>)
            </li>
            <li>
                <img src="/images/icons/armor.png" alt="." width="12" height="12" class="link-icon">
                <span class="minor">Защита:</span> <span><?= $userData['defense']; ?></span>
            </li>
            <li>
                <img src="/images/icons/xswords.png" alt="." width="12" height="12" class="link-icon">
                <span class="minor">Сумма характеристик:</span> <span><?= $userData['health'] + $userData['damage'] + $userData['defense']; ?></span>
            </li>
            <span class="minor">(без учета бонусов)</span><br>
            <li>
                <img src="/images/icons/experience_stroke.png" alt="" class="link-icon">
                <span class="minor">Опыт:</span> 19864.44M / 25945.05M (18%)
            </li>
        </ol>
        
        <!-- Игровое время -->
        <div>
            <img src="/images/icons/clock.png" alt="."> 
            <span>Игровое время: <?= sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); ?></span>
        </div>
        
        <!-- Информация о персонаже -->
        <div class="pt">
            <div>
                <span><?= $isOnline ? 'Онлайн' : 'Оффлайн'; ?>, <?= $pageTitle; ?></span>
            </div>
            <div>
                <span class="minor"><?= $registrationDate; ?></span>
            </div>
        </div>

        <!-- Блок с ID персонажа -->
        <div class="pt small minor">
            <img src="/images/icons/game_master.png" alt="." width="12" height="12">
            ID персонажа: <span><?= $userData['user_id']; ?></span>
        </div>
    </div>
    
    <div class="footer block-border-top"><div>
</div></div>

    <?php
        require_once '/home/host1421897/sakhwow.su/htdocs/www/templates/footer.php';
        ?>
</div>
<?php
        require_once '/home/host1421897/sakhwow.su/htdocs/www/templates/index_footer.php';
        ?>
</body>
</html>