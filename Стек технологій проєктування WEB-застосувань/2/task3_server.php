<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: task3_form.php"); // Повертаємо на форму, якщо це не POST
  exit;
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Інформація про сервер</title>
</head>

<body>
  <h2>Інформація з $_SERVER:</h2>
  <ul>
    <li><b>IP-адреса клієнта:</b> <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
    <li><b>Браузер (User Agent):</b> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>
    <li><b>Скрипт:</b> <?php echo $_SERVER['PHP_SELF']; ?></li>
    <li><b>Метод запиту:</b> <?php echo $_SERVER['REQUEST_METHOD']; ?></li>
    <li><b>Шлях до файлу:</b> <?php echo $_SERVER['SCRIPT_FILENAME']; ?></li>
  </ul>
  <a href="task3_form.php">Повернутися</a>
</body>

</html>