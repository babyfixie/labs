<?php
require_once 'QueryBuilderInterface.php';

class PostgreSQLQueryBuilder implements QueryBuilderInterface
{
  // Змінна для зберігання запиту
  private $query;

  // Формуємо SELECT-запит
  public function select($table, $fields)
  {
    $fieldsList = implode(', ', $fields);
    $this->query = "SELECT $fieldsList FROM $table";
    return $this;
  }

  // Додаємо WHERE умову
  public function where($field, $value)
  {
    $this->query .= " WHERE $field = '$value'";
    return $this;
  }

  // Додаємо LIMIT
  public function limit($number)
  {
    $this->query .= " LIMIT $number";
    return $this;
  }

  // Повертаємо готовий SQL-запит
  public function getSQL()
  {
    return $this->query . ";";
  }
}
