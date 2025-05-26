<!-- footer.php -->

<?php
// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

// Инициализация сессии
session_start();

// Проверка наличия пользователя
if (isset($_SESSION['user_id'])) {
    // Соединение с базой данных
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Получаем данные пользователя по его ID
        $stmt = $pdo->prepare("SELECT character_class, side, level, experience FROM users WHERE user_id=:user_id");
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            die('Пользователь не найден!');
        }

        // Определяем путь к изображению в зависимости от класса и стороны
        $imagePath = '';
        switch ($userData['character_class']) {
            case 'Warrior':
                $imagePath = $userData['side'] === 'Light' ? 'user_1_3.png' : 'user_2_3.png';
                break;
            case 'Mage':
                $imagePath = $userData['side'] === 'Light' ? 'user_1_1.png' : 'user_2_1.png';
                break;
            case 'Monk':
                $imagePath = $userData['side'] === 'Light' ? 'user_1_2.png' : 'user_2_2.png';
                break;
        }

    } catch (PDOException $e) {
        die('Ошибка базы данных: ' . $e->getMessage());
    }
} else {
    // Пользователь не залогинен
    die('Пользователь не залогинен!');
}
?>

<div class="footer nav block-border-top">
    <ol>
        <li>
            <?php if ($_SERVER['PHP_SELF'] !== '/templates/city/city.php') { ?>
             <img src="/images/icons/home.png" alt=".">   <a href="/templates/city/city.php">Город</a> 
            <?php } ?>
         </li>   
         <li>   
            <img src="/images/icons/<?php echo $imagePath; ?>" alt="."> <a href="/templates/user.php?id=<?php echo $_SESSION['user_id']; ?>" class=""><span>Персонаж</span> <span><?php echo $userData['level']; ?> ур.</span></a>
        </li>
        <li>
            <img src="/images/icons/rack.png" class="i12img" width="12" height="12"> <a href="#" class="">Рюкзак</a>
        </li>
        <li>
            <img class="i12img" src="/images/icons/question_blue.png" alt="." width="12px" height="12px"> <a href="https://m.vten.ru/help/first-help">Первая помощь</a>
        </li>
        
        <li>
            <img class="i12img" src="/images/icons/cross.png" alt="." width="12px" height="12px"> <a href="/templates/logout.php">Выход</a>
        </li>
        
        
    </ol>
</div>