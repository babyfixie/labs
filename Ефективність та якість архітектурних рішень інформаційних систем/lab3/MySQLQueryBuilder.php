<?php
require_once 'QueryBuilderInterface.php';

class MySQLQueryBuilder implements QueryBuilderInterface
{
  // Змінна для зберігання побудованого SQL-запиту
  private $query;

  // Метод для формування SELECT частини запиту
  // $table - назва таблиці, $fields - масив полів для вибірки
  public function select($table, $fields)
  {
    $fieldsList = implode(', ', $fields);
    $this->query = "SELECT $fieldsList FROM $table";
    return $this;
  }

  // Метод для додавання умови WHERE до запиту
  // $field - поле для фільтрації, $value - значення
  public function where($field, $value)
  {
    $this->query .= " WHERE $field = '$value'";
    return $this;
  }

  // Метод для додавання обмеження кількості рядків (LIMIT)
  // $number - максимальна кількість записів
  public function limit($number)
  {
    $this->query .= " LIMIT $number";
    return $this;
  }

  // Метод для отримання фінального SQL-запиту
  public function getSQL()
  {
    return $this->query . ";";
  }
}
