<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $email = $_POST['email'];
  // password_hash
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $user, $email, $pass);

  if ($stmt->execute()) {
    echo "Реєстрація успішна! <a href='login.php'>Увійти</a>";
  } else {
    echo "Помилка: " . $stmt->error;
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
  <title>Реєстрація</title>
</head>

<body>
  <h2>Форма реєстрації</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Логін" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit">Зареєструватися</button>
  </form>
  <p>Вже є акаунт? <a href="login.php">Увійти</a></p>
</body>

</html>