<?php
session_start();

$validLogin = "admin";
$validPassword = "123";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
  if ($_POST['login'] === $validLogin && $_POST['password'] === $validPassword) {
    $_SESSION['logged_user'] = $_POST['login'];
    header("Location: task2.php"); // Змінено редірект
    exit;
  } else {
    $error = "Невірний логін або пароль!";
  }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  session_unset();
  session_destroy();
  header("Location: task2.php"); // Змінено редірект
  exit;
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Завдання 2 - Session</title>
</head>

<body>
  <h2>Робота з $_SESSION</h2>
  <?php if (isset($_SESSION['logged_user'])): ?>
    <h3 style="color: blue;">Вітаємо, <?php echo htmlspecialchars($_SESSION['logged_user']); ?>!</h3>
    <a href="?action=logout"><button>Вихід</button></a>
  <?php else: ?>
    <?php if (isset($error))
      echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="login" placeholder="Логін (admin)" required><br><br>
      <input type="password" name="password" placeholder="Пароль (123)" required><br><br>
      <button type="submit">Увійти</button>
    </form>
  <?php endif; ?>
</body>

</html>