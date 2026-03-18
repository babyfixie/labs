<?php
session_start();
$timeout = 300;

if (isset($_SESSION['last_activity'])) {
  $elapsed = time() - $_SESSION['last_activity'];
  if ($elapsed > $timeout) {
    session_unset();
    session_destroy();
    $msg = "<h3 style='color: red;'>Сесія завершилась (неактивність > 5 хв).</h3>";
  } else {
    $msg = "<h3 style='color: green;'>Сесія активна. Неактивність: $elapsed сек.</h3>";
  }
} else {
  $msg = "<h3>Сесія створена. Оновіть сторінку.</h3>";
}

if (session_status() === PHP_SESSION_ACTIVE) {
  $_SESSION['last_activity'] = time();
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Завдання 5 - Таймаут</title>
</head>

<body>
  <h2>Таймаут сесії</h2>
  <?php echo $msg; ?>
  <button onclick="window.location.reload();">Оновити сторінку</button>
</body>

</html>