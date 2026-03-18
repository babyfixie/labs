<?php

require_once 'Notification.php';
require_once 'SMS.php';

// Адаптер для SMS, який реалізує інтерфейс Notification
// Дозволяє використовувати клас SMS через інтерфейс Notification
class SMSAdapter implements Notification
{
  // Об'єкт SMS, до якого делегується відправка повідомлень
  private $sms;

  // Конструктор приймає об'єкт SMS
  public function __construct(SMS $sms)
  {
    $this->sms = $sms;
  }

  // Метод send викликає відповідний метод SMS для відправки повідомлення
  public function send($title, $message)
  {
    $this->sms->sendSMS($title, $message);
  }
}
