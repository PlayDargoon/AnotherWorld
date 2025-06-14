<?php
class DatabaseConnection
{
    private static $instance;
    private $pdo;

    private function __construct()
    {
        $config = include('../config/database.php'); // Путь относительно текущего файла

        $this->pdo = new PDO(
            "{$config['driver']}:host={$config['host']};dbname={$config['database']}",
            $config['username'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
