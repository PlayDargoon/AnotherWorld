<?php
// src/controllers/LogoutController.php
class LogoutController
{
    public function index()
    {
        // Закрываем сессию
        session_start();
        $userId = $_SESSION['user_id'];

        // Получаем время входа
        $userModel = new User(DatabaseConnection::getInstance()->getPdo());
        $loginTime = $userModel->getLoginTime($userId);

        // Вычисляем игровое время
        $logoutTime = time();
        $gameTime = $logoutTime - strtotime($loginTime);

        // Обновляем общее игровое время
        $userModel->updateTotalGameTime($userId, $gameTime);

        // Обновляем время выхода
        $userModel->updateLogoutTime($userId);

        session_unset();
        session_destroy();

        // Перенаправляем на главную страницу
        header('Location: /');
        exit;
    }
}