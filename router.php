<?php
// router.php
require_once 'src/utils.php'; // Добавляешь этот include первым делом
require_once 'src/controllers/IndexController.php';
require_once 'src/controllers/LoginController.php';
require_once 'src/controllers/RegisterController.php'; // Добавляем контроллер регистрации
require_once 'src/controllers/ProfileController.php'; // Добавляем контроллер профиля
require_once 'src/controllers/LogoutController.php'; // Добавляем контроллер выхода
require_once 'src/models/User.php'; // Подключаем модель User
require_once 'src/services/DatabaseConnection.php';

// Экземпляр модели
$userModel = new User(DatabaseConnection::getInstance()->getPdo());

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/': // Главная страница
        $controller = new IndexController();
        $controller->index();
        break;
    case '/login': // Форма входа
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new LoginController($userModel);
            $controller->processLogin();
        } else {
            $controller = new LoginController($userModel);
            $controller->index();
        }
        break;
    case '/register': // Регистрация
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new RegisterController($userModel);
            $controller->processRegistration();
        } else {
            $controller = new RegisterController($userModel);
            $controller->index();
        }
        break;
    case '/profile': // Страница профиля
        $controller = new ProfileController($userModel);
        $controller->index();
        break;
    case '/edit_profile': // Редактирование профиля
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new EditProfileController($userModel);
            $controller->processEdit();
        } else {
            $controller = new EditProfileController($userModel);
            $controller->index();
        }
        break;
    case '/logout': // Выход из системы
        $controller = new LogoutController();
        $controller->index();
        break;
    default:
        echo 'Страница не найдена!';
}