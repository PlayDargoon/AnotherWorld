// update_online_time.php
<?php
session_start();

// Получаем ID пользователя из сессии
$userId = $_SESSION['user_id'];

// Получаем время начала игры
$startTime = $_SESSION['game_start_time'];

// Вычисляем прошедшее время в секундах
$elapsedTime = time() - $startTime;

// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

// Соединение с базой данных
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Обновляем поле play_time в базе данных
    $stmt = $pdo->prepare("UPDATE users SET play_time = play_time + :elapsed_time WHERE user_id = :user_id");
    $stmt->execute([':elapsed_time' => $elapsedTime, ':user_id' => $userId]);

    // Сбрасываем время начала игры
    $_SESSION['game_start_time'] = time();

    echo json_encode(['status' => 'success']);

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}
?>