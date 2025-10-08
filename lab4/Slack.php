<?php

// Клас Slack відповідає за відправку повідомлень у Slack
class Slack
{
  // Логін користувача Slack
  private $login;
  // API ключ для авторизації у Slack
  private $apiKey;
  // Ідентифікатор чату, куди буде відправлено повідомлення
  private $chatId;

  // Конструктор приймає логін, API ключ та ID чату
  public function __construct($login, $apiKey, $chatId)
  {
    $this->login = $login;
    $this->apiKey = $apiKey;
    $this->chatId = $chatId;
  }

  // Метод для відправки повідомлення у Slack
  // Приймає заголовок ($title) та текст повідомлення ($message)
  public function postMessage($title, $message)
  {
    // Імітація відправки повідомлення - виводимо на екран
    echo "Sent Slack message to chat '{$this->chatId}' with title '$title' and message '$message'.<br>";
  }
}
