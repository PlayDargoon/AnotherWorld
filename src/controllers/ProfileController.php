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
        // Проверка авторизации
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Пользователь не авторизован, перенаправляем на главную страницу
            header('Location: /');
            exit;
        }

        // Получаем ID пользователя из сессии
        $userId = $_SESSION['user_id'];

        // Загружаем персонажа из базы данных
        $player = $this->userModel->findById($userId);

        // Получаем время входа
        $loginTime = $player['login_time'];

        // Вычисляем текущее игровое время
        $currentTime = time();
        $gameTime = $currentTime - strtotime($loginTime);

        // Обновляем общее игровое время
        $this->userModel->updateTotalGameTime($userId, $gameTime);

        // Получаем общее игровое время
        $totalGameTime = $this->userModel->getTotalGameTime($userId);

        // Преобразуем время в формат часы:минуты:секунды
        $hours = floor($totalGameTime / 3600);
        $minutes = floor(($totalGameTime % 3600) / 60);
        $seconds = $totalGameTime % 60;
        $formattedGameTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        // Передаем данные в шаблон
        $data = [
            'pageTitle' => 'Игра "Иной Мир" - ' . $player['char_name'],
            'contentFile' => 'pages/profile.html.php',
            'player' => $player,
            'registrationDate' => $player['reg_date'],
            'gameTime' => $formattedGameTime
        ];

        renderTemplate('layout.html.php', $data);
    }
}