<?php
// src/controllers/ProfileController.php
class ProfileController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        // Получаем ID пользователя из сессии
        session_start();
        $userId = $_SESSION['user_id'];

        // Загружаем персонажа из базы данных
        $player = $this->userModel->findById($userId);

        // Передаем данные в шаблон
        $data = [
            'pageTitle' => 'Игра "Иной Мир" - ' . $player['char_name'],
            'contentFile' => 'pages/profile.html.php',
            'player' => $player
        ];

        renderTemplate('layout.html.php', $data);
    }
}