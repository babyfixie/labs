<?php

require_once 'Downloader.php';

// Простий завантажувач без кешу
class SimpleDownloader implements Downloader
{
  public function download($url)
  {
    // Повертає "завантажені" дані
    return "Data from " . $url;
  }
}
