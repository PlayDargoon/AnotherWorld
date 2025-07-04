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

        // Обновляем живучесть персонажа
        $this->userModel->updateVitality($userId, $player['health']);

        // Обновляем урон персонажа
        $this->userModel->updateDamage($userId, $player['strength']);

        // Получаем время входа
        $loginTime = $player['login_time'];

        // Вычисляем текущее игровое время
        $currentTime = time();
        $gameTime = $currentTime - strtotime($loginTime);

        // Обновляем общее игровое время, только если пользователь авторизован
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            $this->userModel->updateTotalGameTime($userId, $gameTime);
        }

        // Получаем общее игровое время
        $totalGameTime = $this->userModel->getTotalGameTime($userId);

        // Преобразуем время в формат часы:минуты:секунды
        $hours = floor($totalGameTime / 3600);
        $minutes = floor(($totalGameTime % 3600) / 60);
        $seconds = $totalGameTime % 60;
        $formattedGameTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        // Форматируем дату регистрации
        $date = date('d M Y', strtotime($player['reg_date']));
        $months = [
            'Jan' => 'янв.',
            'Feb' => 'февр.',
            'Mar' => 'мар.',
            'Apr' => 'апр.',
            'May' => 'май',
            'Jun' => 'июн.',
            'Jul' => 'июл.',
            'Aug' => 'авг.',
            'Sep' => 'сен.',
            'Oct' => 'окт.',
            'Nov' => 'нояб.',
            'Dec' => 'дек.'
        ];
        $formattedRegistrationDate = strtr($date, $months);

        // Определяем статус персонажа
        $logoutTime = $player['logout_time'];
        $timeSinceLogout = time() - strtotime($logoutTime);
        $status = $timeSinceLogout < 600 ? 'Онлайн' : 'Оффлайн'; // 600 секунд = 10 минут

        // Получаем валюту
        $gold = $this->userModel->getGold($userId);
        $silver = $this->userModel->getSilver($userId);

        // Получаем критический урон
        $critChance = $this->userModel->getCritChance($userId);

        // Рассчитываем сумму характеристик
        $totalStats = $player['health'] + $player['strength'] + $player['defense'];

        // Передаем данные в шаблон
        $data = [
            'pageTitle' => 'Игра "Иной Мир" - ' . $player['char_name'],
            'contentFile' => 'pages/profile.html.php',
            'player' => $player,
            'registrationDate' => $formattedRegistrationDate,
            'gameTime' => $formattedGameTime,
            'status' => $status,
            'characterId' => $player['id'], // Добавляем ID персонажа
            'gold' => $gold,
            'silver' => $silver,
            'critChance' => $critChance,
            'totalStats' => $totalStats
        ];

        renderTemplate('layout.html.php', $data);
    }

    // ...


    // Тестовая функция для траты валюты
    public function spendCurrency()
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

        // Тратим 10 золота и 50 серебра
        $this->userModel->changeCurrency($userId, -10, -50);

        // Перенаправляем на профиль
        header('Location: /profile');
        exit;
    }

    // Тестовая функция для добычи валюты
    public function earnCurrency()
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

        // Добыча 20 золота и 100 серебра
        $this->userModel->changeCurrency($userId, 20, 100);

        // Перенаправляем на профиль
        header('Location: /profile');
        exit;
    }

}