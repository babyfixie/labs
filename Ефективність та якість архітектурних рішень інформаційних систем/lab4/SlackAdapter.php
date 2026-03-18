<?php

require_once 'Notification.php';
require_once 'Slack.php';

// Адаптер для Slack, який реалізує інтерфейс Notification
class SlackAdapter implements Notification
{
  // Об'єкт Slack, до якого делегується відправка повідомлень
  private $slack;

  // Конструктор приймає об'єкт Slack
  public function __construct(Slack $slack)
  {
    $this->slack = $slack;
  }

  // Метод send викликає відповідний метод Slack для відправки повідомлення
  public function send($title, $message)
  {
    $this->slack->postMessage($title, $message);
  }
}
