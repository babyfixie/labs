<?php

// Спільний інтерфейс для будівельників SQL-запитів
interface QueryBuilderInterface
{
  // Вибірка полів з таблиці
  public function select($table, $fields);

  // Додавання умови WHERE
  public function where($field, $value);

  // Обмеження кількості результатів
  public function limit($number);

  // Повернення зібраного SQL-запиту
  public function getSQL();
}
