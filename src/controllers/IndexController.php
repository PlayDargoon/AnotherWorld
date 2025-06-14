<?php
// src/controllers/IndexController.php
class IndexController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Главная страница',
            'contentFile' => 'pages/home.html.php' // Передаем путь к шаблону страницы
        ];

        renderTemplate('layout.html.php', $data); // Передаем данные в шаблон
    }
}
