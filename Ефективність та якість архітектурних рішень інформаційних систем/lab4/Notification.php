<?php

// Інтерфейс Notification визначає метод send,
// який мають реалізовувати всі класи сповіщень
interface Notification
{
  // Метод send приймає заголовок ($title) та текст повідомлення ($message)
  public function send($title, $message);
}
