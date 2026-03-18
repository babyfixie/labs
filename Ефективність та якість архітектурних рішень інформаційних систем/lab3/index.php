<?php
require_once 'MySQLQueryBuilder.php';
require_once 'PostgreSQLQueryBuilder.php';

echo "<h2>MySQL Builder</h2>";

// Створюємо будівельника для MySQL
$mysqlBuilder = new MySQLQueryBuilder();
$mysqlSQL = $mysqlBuilder
  ->select("users", array("id", "name"))  // Вибираємо поля id, name з таблиці users
  ->where("active", 1)  // Додаємо умову active = 1
  ->limit(10) // Обмежуємо 10 записами
  ->getSQL(); // Отримуємо сформований SQL-запит

echo "<pre>$mysqlSQL</pre>";

echo "<h2>PostgreSQL Builder</h2>";

// Створюємо будівельника для PostgreSQL
$pgsqlBuilder = new PostgreSQLQueryBuilder();
$pgsqlSQL = $pgsqlBuilder
  ->select("users", array("id", "name"))  // Аналогічно для PostgreSQL
  ->where("active", 1)
  ->limit(5)  // Тут limit 5
  ->getSQL();

echo "<pre>$pgsqlSQL</pre>";
