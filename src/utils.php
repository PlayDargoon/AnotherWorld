<?php
// src/utils.php
function renderTemplate(string $templatePath, array $data = []): void
{
    try {
        // Автоматически формируем полный путь к шаблону
        $fullTemplatePath = __DIR__ . '/../templates/' . $templatePath;

        // Преобразуем массив данных в переменные для использования в шаблонах
        extract($data);

        // Начинаем буферизацию вывода
        ob_start();

        // Подключаем сам шаблон
        include $fullTemplatePath;

        // Получаем содержимое буфера
        $content = ob_get_clean();

        // Подключаем общий шаблон, передавая контент
        include __DIR__ . '/../templates/layout.html.php';
    } catch (\Throwable $th) {
        // В случае ошибки выводим сообщение об ошибке
        die("Ошибка при рендеринге шаблона: {$th->getMessage()} в {$th->getFile()} на линии {$th->getLine()}");
    }
}