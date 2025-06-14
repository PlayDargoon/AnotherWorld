<?php
// src/controllers/ResetPasswordController.php
class ResetPasswordController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $token = $_GET['token'];

        // Проверка существования токена
        $user = $this->userModel->findByPasswordResetToken($token);

        if ($user) {
            $data = [
                'pageTitle' => 'Сброс пароля',
                'contentFile' => 'pages/reset_password.html.php',
                'token' => $token
            ];

            renderTemplate('layout.html.php', $data);
        } else {
            // Токен не найден
            $errors[] = 'Токен для сброса пароля не найден или истек.';
            $data = [
                'pageTitle' => 'Сброс пароля',
                'contentFile' => 'pages/reset_password.html.php',
                'errors' => $errors
            ];

            renderTemplate('layout.html.php', $data);
        }
    }

    public function processResetPassword()
    {
        // Получаем данные из формы
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Проверка совпадения паролей
        if ($password !== $confirmPassword) {
            $errors[] = 'Пароли не совпадают.';
            $data = [
                'pageTitle' => 'Сброс пароля',
                'contentFile' => 'pages/reset_password.html.php',
                'token' => $token,
                'errors' => $errors
            ];

            renderTemplate('layout.html.php', $data);
            return;
        }

        // Проверка существования токена
        $user = $this->userModel->findByPasswordResetToken($token);

        if ($user) {
            // Обновляем пароль
            $hashPass = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->updatePassword($user['id'], $hashPass);

            // Удаляем токен для сброса пароля
            $this->userModel->clearPasswordResetToken($user['id']);

            // Перенаправляем на страницу входа
            header('Location: /login');
            exit;
        } else {
            // Токен не найден
            $errors[] = 'Токен для сброса пароля не найден или истек.';
            $data = [
                'pageTitle' => 'Сброс пароля',
                'contentFile' => 'pages/reset_password.html.php',
                'token' => $token,
                'errors' => $errors
            ];

            renderTemplate('layout.html.php', $data);
        }
    }
}