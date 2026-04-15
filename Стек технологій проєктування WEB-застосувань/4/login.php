<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $user);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    // check password hash
    if (password_verify($pass, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $user;
      header("Location: welcome.php");
      exit();
    } else {
      echo "Невірний пароль.";
    }
  } else {
    echo "Користувача не знайдено.";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
  <title>Авторизація</title>
</head>

<body>
  <h2>Вхід у систему</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Логін" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit">Увійти</button>
  </form>
  <p>Немає акаунту? <a href="register.php">Зареєструватися</a></p>
</body>

</html>