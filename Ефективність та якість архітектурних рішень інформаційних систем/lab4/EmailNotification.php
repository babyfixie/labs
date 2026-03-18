<?php

require_once 'Notification.php';

class EmailNotification implements Notification
{
  // Адреса електронної пошти адміністратора, на яку відправляються повідомлення
  private $adminEmail;

  // Конструктор приймає email адміністратора
  public function __construct($adminEmail)
  {
    $this->adminEmail = $adminEmail;
  }

  // Метод для відправки повідомлення
  // Приймає заголовок ($title) та текст повідомлення ($message)
  public function send($title, $message)
  {
    // Імітація відправки email — виводимо повідомлення на екран
    echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.<br>";
  }
}
