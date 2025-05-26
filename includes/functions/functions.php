<?php
// functions.php
function writeLog($message) {
    // Открываем log-файл для записи
    $logFilePath = __DIR__ . '/logs/error.log'; // Положим лог-файл в папку logs
    $currentDateTime = date('Y-m-d H:i:s');

    // Формируем запись в журнале
    $logEntry = "[$currentDateTime] $message\n";

    // Записываем в файл
    file_put_contents($logFilePath, $logEntry, FILE_APPEND | LOCK_EX);
}

?>