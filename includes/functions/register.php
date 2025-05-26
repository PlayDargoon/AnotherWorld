<!-- register.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
</head>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
</head>



<body id="body_id" ignorewebview="true">
<div class="touch-influenced block-border">

<?php
$loadStart = microtime(true); // Начинаем замер времени
session_start();

// Функции для обработки каждого этапа регистрации
function showSelectClassForm() {
    echo <<<FORM
    <div class="body">
        <h2>Шаг 1: Выберите класс персонажа</h2>
        <form action="" method="POST">
            <input type="radio" id="warrior" name="step1" value="Warrior" required>
            <label for="warrior">Воин (Здоровье: 20, Урон: 30, Защита: 50)</label><br>
            <input type="radio" id="mage" name="step1" value="Mage" required>
            <label for="mage">Маг (Здоровье: 25, Урон: 50, Защита: 25)</label><br>
            <input type="radio" id="monk" name="step1" value="Monk" required>
            <label for="monk">Монах (Здоровье: 40, Урон: 40, Защита: 20)</label><br><br>
            <button type="submit">Далее</button>
        </form>
    </div>
FORM;
}

function showSelectGenderForm($characterClass) {
    echo <<<FORM
    <div class="body">
        <h2>Шаг 2: Выберите пол персонажа</h2>
        <form action="" method="POST">
            <input type="hidden" name="character_class" value="{$characterClass}">
            <input type="radio" id="male" name="step2" value="Male" required>
            <label for="male">Мужской</label><br>
            <input type="radio" id="female" name="step2" value="Female" required>
            <label for="female">Женский</label><br><br>
            <button type="submit">Далее</button>
        </form>
    </div>
FORM;
}

function showSelectSideForm($characterClass, $gender) {
    echo <<<FORM
    <div class="body">
        <h2>Шаг 3: Выберите сторону персонажа</h2>
        <form action="" method="POST">
            <input type="hidden" name="character_class" value="{$characterClass}">
            <input type="hidden" name="gender" value="{$gender}">
            <input type="radio" id="light" name="step3" value="Light" required>
            <label for="light">Светлая сторона</label><br>
            <input type="radio" id="dark" name="step3" value="Dark" required>
            <label for="dark">Темная сторона</label><br><br>
            <button type="submit">Далее</button>
        </form>
    </div>
FORM;
}

function showRegistrationForm($characterClass, $gender, $side) {
    echo <<<FORM
    <div class="body">
        <h2>Шаг 4: Зарегистрируйтесь</h2>
        <form action="process_register.php" method="POST">
            <input type="hidden" name="character_class" value="{$characterClass}">
            <input type="hidden" name="gender" value="{$gender}">
            <input type="hidden" name="side" value="{$side}">
            <label for="reg_username">Имя пользователя:</label><br>
            <input type="text" id="reg_username" name="reg_username" required><br>
            <label for="reg_email">Email:</label><br>
            <input type="email" id="reg_email" name="reg_email" required><br>
            <label for="reg_password">Пароль:</label><br>
            <input type="password" id="reg_password" name="reg_password" required><br>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
FORM;
}

// Основная логика обработки регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['step1'])) {
        // Первый шаг: выбрали класс персонажа
        $characterClass = $_POST['step1'];
        showSelectGenderForm($characterClass);
    } elseif (isset($_POST['step2'])) {
        // Второй шаг: выбрали пол персонажа
        $characterClass = $_POST['character_class'];
        $gender = $_POST['step2'];
        showSelectSideForm($characterClass, $gender);
    } elseif (isset($_POST['step3'])) {
        // Третий шаг: выбрали сторону персонажа
        $characterClass = $_POST['character_class'];
        $gender = $_POST['gender'];
        $side = $_POST['step3'];
        showRegistrationForm($characterClass, $gender, $side);
    } else {
        // Изначально выводим первую форму (выбор класса)
        showSelectClassForm();
    }
} else {
    // Изначально выводим первую форму (выбор класса)
    showSelectClassForm();
}





?>

<div class="footer block-border-top">
<a href="/index.php">
<img src="/images/icons/home.png" class="link-icon">
<span>На главную</span>
</a>
</br>
<a href="#">
<img src="/images/icons/question_blue.png" class="link-icon">
<span>Первая помощь</span>
</a>
</div>

</div>
<?php
require_once '/home/host1421897/sakhwow.su/htdocs/www/templates/index_footer.php';
?>
</body>


</html>
<body>