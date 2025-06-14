<?php
// src/controllers/LogoutController.php
class LogoutController
{
    public function index()
    {
        // Закрываем сессию
        session_start();
        session_unset();
        session_destroy();

        // Перенаправляем на главную страницу
        header('Location: /');
        exit;
    }
}