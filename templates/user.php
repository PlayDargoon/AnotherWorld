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

// Подключаем файл с функциями
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/functions/user_functions.php';

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
    $userData = getUserData($pdo, $userId);

    if (!$userData) {
        die('Пользователь не найден!');
    }

    // Обновляем значение vitality
    $newVitality = $userData['health'] * 10;
    if ($newVitality !== $userData['vitality']) {
        updateVitality($pdo, $userId, $newVitality);
    }

    // Получаем обновленные данные пользователя
    $userData = getUpdatedUserData($pdo, $userId);

    if (!$userData) {
        die('Пользователь не найден!');
    }

    // Получаем текущий опыт персонажа
    $experienceData = getExperience($pdo, $userId);
    $currentExperience = $experienceData['experience'];
    $currentLevel = $experienceData['level'];

    // Получаем идентификатор следующего уровня
    $nextLevelId = getNextLevelId($pdo, $currentLevel);

    // Получаем необходимое количество опыта для следующего уровня
    $requiredExperience = getRequiredExperience($pdo, $nextLevelId);

    // Вычисляем, сколько опыта осталось до следующего уровня
    $remainingExperience = $requiredExperience - $currentExperience;
    
     // Вычисляем процент прогресса до следующего уровня
    $progressPercentage = calculateProgressPercentage($currentExperience, $requiredExperience);


    // Определяем путь к изображению пола
    $genderImagePath = getGenderImagePath($userData['gender']);

    // Перевод значений на русский язык
    $sideTranslation = translateSide($userData['side']);
    $classTranslation = translateClass($userData['character_class']);

    // Форматируем значения
    $formattedValues = formatValues($userData['health'], $userData['damage'], $userData['defense'], $userData['vitality']);

    // Проверяем статус онлайн
    $isOnline = isOnline(strtotime($userData['last_activity']));

    // Определение текущей страницы
    $pageTitle = getPageTitle($_SERVER['REQUEST_URI']);

    // Дата регистрации
    $registrationDate = getRegistrationDate($userData['created_at']);

    // Преобразуем игровое время в понятный формат
    $playTime = formatPlayTime($userData['play_time']);

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
                <span class="minor">Живучесть:</span> <span id="health-value"><?= $userData['health']; ?></span> (<span id="vitality-value"><?= $formattedValues['vitality']; ?></span> здоровья)
            </li>
            <li>
                <img src="/images/icons/strength.png" alt="." width="12" height="12" class="link-icon">
                <span class="minor">Сила:</span> <span><?= $userData['damage']; ?></span> (удар ~<span><?= $formattedValues['damage']; ?></span>)
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
                <span class="minor">Опыт:</span> <?= $currentExperience; ?> / <?= $remainingExperience; ?> (<?= $progressPercentage; ?>%)
            </li>
            
            
        </ol>
        
        <!-- Игровое время -->
        <div>
            <img src="/images/icons/clock.png" alt="."> 
            <span>Игровое время: <?= $playTime; ?></span>
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