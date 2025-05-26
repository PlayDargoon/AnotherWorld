<!-- process_register.php -->
<?php
session_start();

// Параметры соединения с базой данных
$db_host = 'localhost';
$db_name = 'host1421897_game';
$db_user = 'host1421897_game';
$db_pass = '1234567890';

try {
    // Соединение с базой данных
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные из формы
    $username = trim($_POST['reg_username']);
    $email = trim($_POST['reg_email']);
    $password = trim($_POST['reg_password']);
    $characterClass = trim($_POST['character_class']);
    $gender = trim($_POST['gender']);
    $side = trim($_POST['side']);

    // Хэшируем пароль для безопасного хранения
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Определяем начальные значения характеристик в зависимости от класса персонажа
    switch ($characterClass) {
        case 'Warrior':
            $health = 20;
            $damage = 30;
            $defense = 50;
            break;
        case 'Mage':
            $health = 25;
            $damage = 50;
            $defense = 25;
            break;
        case 'Monk':
            $health = 40;
            $damage = 40;
            $defense = 20;
            break;
        default:
            throw new Exception('Недопустимый класс персонажа');
    }

    // Подготовленная SQL-запрос на добавление нового пользователя
    $stmt = $pdo->prepare(
        "INSERT INTO users (username, email, password_hash, character_class, gender, side, health, damage, defense) 
         VALUES (:username, :email, :password, :char_class, :gender, :side, :health, :damage, :defense)"
    );

    // Выполняем запрос
    if ($stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $passwordHash,
        ':char_class' => $characterClass,
        ':gender' => $gender,
        ':side' => $side,
        ':health' => $health,
        ':damage' => $damage,
        ':defense' => $defense
    ])) {
        session_regenerate_id(); // Генерируем новый идентификатор сессии
        $_SESSION['registered_user'] = ['username' => $username, 'email' => $email]; // Сохраняем данные в сессии
        header('Location: /login.php'); // Перенаправляем на страницу входа
        exit;
    } else {
        die('Ошибка регистрации.');
    }

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}