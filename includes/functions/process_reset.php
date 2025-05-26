<!-- process_reset.php -->
<?php
session_start();

// Почта пользователя
$email = $_POST['email'];

// Имитация отправки письма для восстановления пароля
// Здесь можно вызвать API почтового сервиса или отправить письмо через SMTP
echo "<script>alert('Ссылка для восстановления пароля отправлена на ваш e-mail.'); window.location.href='login.php'</script>";

exit;
?>