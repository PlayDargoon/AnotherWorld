<?php
session_start();

// Проверяем, зарегистрировался ли пользователь и началась ли игра
if(isset($_SESSION['user_id']) && !empty($_SESSION['game_start_time'])) {
    // Если пользователь авторизован и начал игру, перенаправляем на город
    header('Location: /includes/city/city.php');
    exit;
}

// Иначе выводим стандартную главную страницу
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Подключаем ваш CSS-дизайн -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Адаптация под мобильные устройства -->
</head>
<?php
// Подключаем файл конфигурации
require_once '/home/host1421897/sakhwow.su/htdocs/www/includes/config.php';

// Соединение с базой данных
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Подсчет количества зарегистрированных игроков
    $stmt = $pdo->prepare("SELECT COUNT(*) as total_players FROM users");
    $stmt->execute();
    $totalPlayers = $stmt->fetchColumn();

} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}
?>

<body id="body_id" ignorewebview="true">
<div class="touch-influenced block-border">

    <div class="body">
        <div style="text-align:center;" class="p2">
            <img src="/images/logo.jpg" width="310" height="103" alt="Логотип"> <!-- ВАШ ЛОГОТИП -->
        </div>
        <h1 style="text-align: center;">Добро пожаловать в Иной Мир!</h1>
        
        
        
       <div class="smail pt">
    <img src="/images/icons/menialo.png" alt="*" style="float:left;margin-right:8px;" class="ic32" width="32" height="32">
    Перед тобой открывается дверь в мир, полный опасностей и сокровищ. Смелее, герой, твой путь начинается здесь!
    <div style="clear: both;"></div>
</div>

<img src="/images/icons/xswords.png" width="12" height="12" alt="."> 
<span class="yellow">В игре уже <span><span class="main-pl"><span class="nowrap"><?= number_format($totalPlayers, 0, '', ' '); ?></span></span> игроков</span>!</span>
</br>
<!-- ОПИСАНИЕ ИГРОВЫХ ЦЕННОСТЕЙ -->
<h2 class="_font-art font16">Тебя ждет:</h2></br>

<div class="section-sep">
<img src="/images/icons/a002.png" style="float: left; margin-right: 10px;">
Более сотни захватывающих квестов, которые погрузят тебя в мир приключений </div></br>


<div class="section-sep">
<img src="/images/icons/a006.png" style="float: left; margin-right: 10px;">
Более 500 уникальных предметов экипировки, которые помогут тебе стать непобедимым </div></br>

<div class="section-sep">
<img src="/images/icons/a005.png" style="float: left; margin-right: 10px;">
Опасные сражения с могущественными врагами, требующие стратегии и мастерства </div></br>

<div class="section-sep">
<img src="/images/icons/a003.png" style="float: left; margin-right: 10px;">
Походы в таинственные подземелья, полные сокровищ и опасностей </div></br>
<!--
<div class="section-sep">
<img src="/images/icons/a008.png" style="float: left; margin-right: 10px;">
Разнообразие профессий, позволяющих выбрать свой уникальный путь </div></br>

<div class="section-sep">
<img src="/images/icons/a004.png" style="float: left; margin-right: 10px;">
Торговля между игроками, где ты можешь обмениваться редкими предметами </div></br>

<div class="section-sep">
<img src="/images/icons/a001.png" style="float: left; margin-right: 10px;">
Незабываемые приключения при прохождении сотен увлекательных квестов </div></br>

<div class="section-sep">
<img src="/images/icons/a011.png" style="float: left; margin-right: 10px;">
Множество локаций, каждая из которых скрывает свои тайны и загадки </div></br>

<div class="section-sep">
<img src="/images/icons/a012.png" style="float: left; margin-right: 10px;">
Легендарные достижения, которые станут предметом гордости для каждого игрока </div></br>
-->

        <a href="/includes/functions/register.php" class="btn-link">Начать приключение</a> </br> <!-- Новая кнопка -->
        <a href="/login.php" class="btn-link" style="margin-top: 20px;">Войти</a> <!-- Новая ссылка -->

      </br>

       
    </div>
    
     
        
        
        
 </div>       

</br>

<?php
require_once 'templates/index_footer.php';
?>


</body>
</html>