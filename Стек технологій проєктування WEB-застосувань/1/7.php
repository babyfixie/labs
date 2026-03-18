<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Форма</title>
</head>

<body style="font-family: sans-serif; padding: 20px;">
  <h2>Введіть ваші дані</h2>
  <form action="process.php" method="POST">
    <label for="first_name">Ім'я:</label><br>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="last_name">Прізвище:</label><br>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <input type="submit" value="Відправити">
  </form>
</body>

</html>