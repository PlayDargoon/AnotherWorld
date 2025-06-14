<?php
// src/controllers/LoginController.php
class LoginController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Вход в игру',
            'contentFile' => 'pages/login.html.php' // Передаем путь к шаблону страницы
        ];

        renderTemplate('layout.html.php', $data); // Передаем данные в шаблон
    }

    public function processLogin()
    {
        // Получаем данные из формы
        $charName = trim($_POST['char_name']);
        $password = trim($_POST['password']);

        // Проверка данных и авторизация через модель
        $user = $this->userModel->login($charName, $password);

        if ($user) {
            // Пользователь авторизован, устанавливаем сессию
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            // Перенаправляем на страницу профиля
            header('Location: /profile');
            exit;
        } else {
            // Ошибка авторизации
            $errors[] = 'Неправильное имя персонажа или пароль.';
            $data = [
                'pageTitle' => 'Вход в игру',
                'contentFile' => 'pages/login.html.php',
                'errors' => $errors
            ];

            renderTemplate('layout.html.php', $data); // Передаем данные в шаблон
        }
    }
}