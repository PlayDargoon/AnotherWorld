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