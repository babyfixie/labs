<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_POST['add_item'])) {
  $_SESSION['cart'][] = htmlspecialchars($_POST['item_name']);
  header("Location: task4.php");
  exit;
}

if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
  $history = isset($_COOKIE['purchase_history']) ? json_decode($_COOKIE['purchase_history'], true) : [];
  $history = array_merge($history, $_SESSION['cart']);
  setcookie("purchase_history", json_encode($history), time() + (30 * 24 * 60 * 60), "/");
  $_SESSION['cart'] = [];
  header("Location: task4.php");
  exit;
}

if (isset($_GET['clear_history'])) {
  setcookie("purchase_history", "", time() - 3600, "/");
  header("Location: task4.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Завдання 4 - Корзина</title>
</head>

<body>
  <h2>Магазин</h2>
  <form method="POST">
    <select name="item_name">
      <option value="Ноутбук">Ноутбук</option>
      <option value="Мишка">Мишка</option>
      <option value="Клавіатура">Клавіатура</option>
    </select>
    <button type="submit" name="add_item">Додати</button>
  </form>
  <hr>
  <h3>Поточна корзина:</h3>
  <?php if (empty($_SESSION['cart'])): ?>
    <p>Порожня.</p>
  <?php else: ?>
    <ul><?php foreach ($_SESSION['cart'] as $item)
      echo "<li>$item</li>"; ?></ul>
    <form method="POST"><button type="submit" name="checkout">Оформити покупку</button></form>
  <?php endif; ?>
  <hr>
  <h3>Історія покупок:</h3>
  <?php
  if (isset($_COOKIE['purchase_history']) && !empty(json_decode($_COOKIE['purchase_history'], true))) {
    echo "<ul>";
    foreach (json_decode($_COOKIE['purchase_history'], true) as $past)
      echo "<li>$past</li>";
    echo "</ul><a href='?clear_history=1'><button>Очистити</button></a>";
  } else
    echo "<p>Пусто.</p>";
  ?>
</body>

</html>