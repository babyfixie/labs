<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['username'])) {
  $username = htmlspecialchars(trim($_POST['username']));
  setcookie("user_name", $username, time() + (7 * 24 * 60 * 60), "/");
  header("Location: task1.php"); // Змінено редірект
  exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  setcookie("user_name", "", time() - 3600, "/");
  header("Location: task1.php"); // Змінено редірект
  exit;
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Завдання 1 - Cookie</title>
</head>

<body>
  <h2>Робота з $_COOKIE</h2>
  <?php if (isset($_COOKIE['user_name'])): ?>
    <h3 style="color: green;">Привіт, <?php echo htmlspecialchars($_COOKIE['user_name']); ?>!</h3>
    <a href="?action=delete"><button>Видалити cookie</button></a>
  <?php else: ?>
    <form method="POST">
      <label>Введіть ваше ім'я:</label><br>
      <input type="text" name="username" required>
      <button type="submit">Зберегти</button>
    </form>
  <?php endif; ?>
</body>

</html>