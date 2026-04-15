<?php
session_start();

// session check
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
  <title>Вітаємо</title>
</head>

<body>
  <h1>Ласкаво просимо, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
  <p>Це захищена сторінка, доступна тільки після авторизації.</p>
  <a href="logout.php">Вийти з системи</a>
</body>

</html>