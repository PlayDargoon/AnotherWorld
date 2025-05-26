<!-- game.php -->
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

    // Получаем данные пользователя по его ID
    $stmt = $pdo->prepare("SELECT username, character_class, gender, side, health, damage, defense FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Пользователь не найден!');
    }

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}

// Выводим шапку сайта
require_once 'templates/header.php';
?>

<div class="body">
    <h2>Игра началась!</h2>
    <p>Имя персонажа: <?= htmlspecialchars($userData['username']); ?></p>
    <p>Класс персонажа: <?= htmlspecialchars($userData['character_class']); ?></p>
    <p>Пол персонажа: <?= htmlspecialchars($userData['gender']); ?></p>
    <p>Сторона персонажа: <?= htmlspecialchars($userData['side']); ?></p>
    <p>Здоровье: <?= $userData['health']; ?></p>
    <p>Урон: <?= $userData['damage']; ?></p>
    <p>Защита: <?= $userData['defense']; ?></p>
    <a href="logout.php" class="btn-link">Выйти из игры</a>
</div>

<?php
// Выводим футер сайта
require_once 'templates/index_footer.php';
?>