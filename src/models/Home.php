<?php
// src/models/Home.php
class Home
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Получает количество зарегистрированных пользователей
     *
     * @return int
     */
    public function getUserCount()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}