<?php
// src/controllers/ForgotPasswordController.php
class ForgotPasswordController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Восстановление пароля',
            'contentFile' => 'pages/forgot_password.html.php'
        ];

        renderTemplate('layout.html.php', $data);
    }

    public function processForgotPassword()
    {
        // Получаем данные из формы
        $email = trim($_POST['email']);

        // Проверка существования пользователя с таким email
        $user = $this->userModel->findByEmail($email);

        if ($user) {
            // Генерируем токен для восстановления пароля
            $token = bin2hex(random_bytes(16));
            $this->userModel->updatePasswordResetToken($user['id'], $token);

            // Отправляем письмо с инструкциями по восстановлению пароля
            $this->sendPasswordResetEmail($user['email'], $token);

            $data = [
                'pageTitle' => 'Восстановление пароля',
                'contentFile' => 'pages/password_reset_sent.html.php'
            ];

            renderTemplate('layout.html.php', $data);
        } else {
            // Пользователь не найден
            $errors[] = 'Пользователь с таким email не найден.';
            $data = [
                'pageTitle' => 'Восстановление пароля',
                'contentFile' => 'pages/forgot_password.html.php',
                'errors' => $errors
            ];

            renderTemplate('layout.html.php', $data);
        }
    }

    private function sendPasswordResetEmail($email, $token)
    {
        // Здесь можно реализовать отправку письма с инструкциями по восстановлению пароля
        // Например, используя PHP mail() или сторонние сервисы, такие как SendGrid или Mailgun

        $subject = 'Восстановление пароля';
        $message = "Здравствуйте!\n\n"
            . "Вы запросили восстановление пароля. Пожалуйста, перейдите по следующей ссылке для сброса пароля:\n\n"
            . "http://yourdomain.com/reset_password?token=$token\n\n"
            . "Если вы не запрашивали восстановление пароля, пожалуйста, проигнорируйте это письмо.\n\n"
            . "С уважением,\n"
            . "Команда Иной Мир";

        $headers = "From: noreply@yourdomain.com\r\n";
        $headers .= "Reply-To: noreply@yourdomain.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        mail($email, $subject, $message, $headers);
    }
}