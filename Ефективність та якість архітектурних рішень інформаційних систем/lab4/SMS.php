<?php

// Клас SMS відповідає за відправку SMS-повідомлень
class SMS
{
  // Номер телефону отримувача
  private $phone;
  // Ім'я відправника SMS
  private $sender;

  // Конструктор приймає номер телефону та ім'я відправника
  public function __construct($phone, $sender)
  {
    $this->phone = $phone;
    $this->sender = $sender;
  }

  // Метод для відправки SMS-повідомлення
  // Приймає заголовок ($title) та текст повідомлення ($message)
  public function sendSMS($title, $message)
  {
    // Імітація відправки SMS - виводимо на екран
    echo "Sent SMS from '{$this->sender}' to phone '{$this->phone}' with title '$title' and message '$message'.<br>";
  }
}
