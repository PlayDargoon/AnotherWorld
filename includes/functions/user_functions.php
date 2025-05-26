<?php
// user_functions.php

// Функция для получения данных пользователя по ID
function getUserData($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT health, vitality FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Функция для обновления значения vitality
function updateVitality($pdo, $userId, $newVitality) {
    $stmt = $pdo->prepare("UPDATE users SET vitality = :vitality WHERE user_id = :user_id");
    $stmt->execute([':vitality' => $newVitality, ':user_id' => $userId]);
}

// Функция для получения обновленных данных пользователя
function getUpdatedUserData($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT username, character_class, gender, side, level, experience, health, damage, defense, vitality, user_id, last_activity, created_at, play_time FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Функция для определения пути к изображению пола
function getGenderImagePath($gender) {
    return $gender === 'Male' ? 'sex_male.png' : 'sex_female.png';
}

// Функция для перевода значений на русский язык
function translateSide($side) {
    return $side === 'Light' ? 'Светлый' : 'Темный';
}

function translateClass($class) {
    switch ($class) {
        case 'Warrior':
            return 'Воин';
        case 'Mage':
            return 'Маг';
        case 'Monk':
            return 'Монах';
        default:
            return '';
    }
}

// Функция для форматирования значений
function formatValues($health, $damage, $defense, $vitality) {
    return [
        'health' => number_format($health, 0, '.', ' '),
        'damage' => number_format($damage, 0, '.', ' '),
        'defense' => number_format($defense, 0, '.', ' '),
        'vitality' => number_format($vitality, 0, '.', ' ')
    ];
}

// Функция для проверки статуса онлайн
function isOnline($lastActivityTimestamp, $onlineThreshold = 300) {
    $now = time();
    return ($now - $lastActivityTimestamp) <= $onlineThreshold;
}

// Функция для определения текущей страницы
function getPageTitle($requestUri) {
    switch ($requestUri) {
        case '/templates/user.php':
            return 'Профиль персонажа';
        case '/templates/city.php':
            return 'Город';
        default:
            return 'Главная страница';
    }
}

// Функция для получения даты регистрации
function getRegistrationDate($createdAt) {
    return date('d M Y', strtotime($createdAt));
}

// Функция для преобразования игрового времени в понятный формат
function formatPlayTime($playTimeInSeconds) {
    $hours = floor($playTimeInSeconds / 3600);
    $minutes = floor(($playTimeInSeconds % 3600) / 60);
    $seconds = $playTimeInSeconds % 60;
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

// Функция для получения опыта персонажа
function getExperience($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT experience, level FROM users WHERE user_id=:user_id");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Функция для получения идентификатора следующего уровня
function getNextLevelId($pdo, $currentLevel) {
    $stmt = $pdo->prepare("SELECT id FROM experience_table WHERE level=:level");
    $stmt->execute([':level' => $currentLevel + 1]);
    return $stmt->fetchColumn();
}

// Функция для получения необходимого опыта для уровня
function getRequiredExperience($pdo, $levelId) {
    $stmt = $pdo->prepare("SELECT required_experience FROM experience_table WHERE id=:level_id");
    $stmt->execute([':level_id' => $levelId]);
    return $stmt->fetchColumn();
}

// Функция для вычисления процента прогресса
function calculateProgressPercentage($currentExperience, $requiredExperience) {
    if ($requiredExperience == 0) {
        return 0; // Или любое другое значение по умолчанию
    }
    $progress = ($currentExperience / $requiredExperience) * 100;
    return round($progress, 2);
}