<?php
// src/controllers/StatsController.php
class StatsController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        // Получаем ID персонажа из запроса
        $characterId = (int) $_GET['id'];

        // Загружаем персонажа из базы данных
        $player = $this->userModel->findById($characterId);

        // Получаем валюту
        $gold = $this->userModel->getGold($characterId);
        $silver = $this->userModel->getSilver($characterId);

        // Получаем критический урон
        $critChance = $this->userModel->getCritChance($characterId);

        // Получаем выбранную характеристику
        $statId = isset($_GET['statId']) ? (int) $_GET['statId'] : 0;

        // Передаем данные в шаблон
        $data = [
            'pageTitle' => 'Характеристики персонажа - ' . $player['char_name'],
            'contentFile' => 'pages/stats.html.php',
            'player' => $player,
            'gold' => $gold,
            'silver' => $silver,
            'critChance' => $critChance,
            'statId' => $statId
        ];

        renderTemplate('layout.html.php', $data);
    }
}