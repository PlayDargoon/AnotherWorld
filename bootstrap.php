<?php

/// bootstrap.php
require_once __DIR__ . '/src/services/DatabaseConnection.php';

// Автозагрузка классов (PSR-4)
spl_autoload_register(function ($className) {
    $filePath = __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

global $pdo;
$pdo = DatabaseConnection::getInstance()->getPdo();

// bootstrap.php
require_once __DIR__ . '/src/services/DatabaseConnection.php';

global $pdo;
$pdo = DatabaseConnection::getInstance()->getPdo();


// Здесь можно добавить ещё автозагрузчик классов (PSR-4) или подключить другие библиотеки