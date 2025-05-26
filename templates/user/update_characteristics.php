<?php
// Включаем отладку ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}

// Возвращаем JSON-ответ
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);