<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $firstName = $_POST['first_name'] ?? '';
  $lastName = $_POST['last_name'] ?? '';

  if (empty(trim($firstName)) || empty(trim($lastName))) {
    echo "<h3 style='color: red;'>Помилка: Всі поля повинні бути заповнені!</h3>";
    echo "<a href='index.html'>Повернутися назад</a>";
  } else {
    $cleanFirstName = htmlspecialchars(trim($firstName));
    $cleanLastName = htmlspecialchars(trim($lastName));

    echo "<h2 style='color: green;'>Привіт, $cleanFirstName $cleanLastName!</h2>";
    echo "<p>Твої дані успішно оброблено.</p>";
    echo "<a href='index.html'>Спробувати ще раз</a>";
  }
} else {
  echo "Будь ласка, заповніть <a href='7.html'>форму</a>.";
}
?>