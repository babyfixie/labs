<?php

// Інтерфейс завантажувача
interface Downloader
{
  // Метод для завантаження даних за URL
  public function download($url);
}

?>