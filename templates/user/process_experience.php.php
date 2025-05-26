<?php
// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

// Получаем ID пользователя и количество полученного опыта из POST-запроса
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
$experienceGained = isset($_POST['experience']) ? intval($_POST['experience']) : 0;

if ($userId === null || $experienceGained <= 0) {
    die('Не указан ID пользователя или опыт.');
}

// Соединение с базой данных
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные пользователя по его ID
    $stmt = $pdo->prepare("SELECT level, experience FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Пользователь не найден!');
    }

    // Обновляем опыт персонажа
    $newExperience = $userData['experience'] + $experienceGained;
    $stmt = $pdo->prepare("UPDATE users SET experience = :experience WHERE user_id = :user_id");
    $stmt->execute([':experience' => $newExperience, ':user_id' => $userId]);

    // Получаем требуемое количество опыта для текущего уровня
    $stmt = $pdo->prepare("SELECT required_experience FROM experience_table WHERE level=:level");
    $stmt->execute([':level' => $userData['level']]);
    $requiredExperience = $stmt->fetchColumn();

    // Проверяем, достиг ли персонаж необходимого количества опыта
    if ($newExperience >= $requiredExperience) {
        // Повышаем уровень персонажа
        $newLevel = $userData['level'] + 1;
        $stmt = $pdo->prepare("UPDATE users SET level = :level WHERE user_id = :user_id");
        $stmt->execute([':level' => $newLevel, ':user_id' => $userId]);
    }

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}