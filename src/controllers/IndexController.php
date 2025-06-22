<?php
// src/controllers/IndexController.php
class IndexController
{
    private $homeModel;

    public function __construct(Home $homeModel)
    {
        $this->homeModel = $homeModel;
    }

    public function index()
    {
        // Проверка авторизации
        session_start();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            // Пользователь залогинен, перенаправляем на страницу профиля
            header('Location: /profile');
            exit;
        }

        // Получаем количество пользователей
        $userCount = $this->homeModel->getUserCount();

        // Передаем данные в шаблон
        $data = [
            'pageTitle' => 'Главная страница',
            'contentFile' => 'pages/home.html.php',
            'userCount' => $userCount
        ];

        renderTemplate('layout.html.php', $data);
    }
}