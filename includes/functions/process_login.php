<!-- process_login.php -->
<?php
session_start(); // Инициализация сессии

// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

try {
    // Соединение с базой данных
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные из формы
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Проверяем существование пользователя
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(); // Генерация нового идентификатора сессии
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id']; // Храним ID пользователя в сессии

        // Устанавливаем время начала игры
        $_SESSION['game_start_time'] = time();

        header('Location: /templates/city/city.php'); // Переход на игровую страницу города
        exit;
    } else {
        echo "<script>alert('Неправильное имя пользователя или пароль.'); window.location.href='login.php'</script>";
    }

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}