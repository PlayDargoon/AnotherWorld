<?php
// src/controllers/RegisterController.php
class RegisterController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Регистрация',
            'contentFile' => 'pages/register.html.php'
        ];
        renderTemplate('layout.html.php', $data);
    }

    public function processRegistration()
    {
        // Получаем данные из формы
        $charName = trim($_POST['char_name']);
        $side = trim($_POST['side']);
        $class = trim($_POST['class']);
        $gender = trim($_POST['gender']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        // Проверка данных и регистрация через модель
        $userData = [
            'char_name' => $charName,
            'password' => $password,
            'email' => $email,
            'class' => $class,
            'side' => $side,
            'gender' => $gender,
            'level' => 1,
            'exp' => 10,
            'health' => 100,
            'strength' => 10,
            'defense' => 10
        ];

        // Проверка на существование пользователя
        if ($this->userModel->checkIfExists($charName, $email)) {
            $errors[] = 'Имя персонажа или email уже заняты.';
        } else {
            if ($this->userModel->validateUserData($userData)) {
                if ($this->userModel->create($userData)) {
                    // Регистрация прошла успешно
                    session_start();
                    $_SESSION['user_id'] = $this->userModel->getLastInsertedId();
                    $_SESSION['logged_in'] = true;
                    header('Location: /profile');
                    exit;
                } else {
                    // Ошибка при регистрации
                    $errors[] = 'Ошибка при регистрации. Попробуйте позже.';
                }
            } else {
                // Ошибки в данных
                $errors[] = 'Некорректные данные.';
            }
        }

        $data = [
            'pageTitle' => 'Регистрация',
            'contentFile' => 'pages/register.html.php',
            'errors' => $errors
        ];
        renderTemplate('layout.html.php', $data);
    }
}