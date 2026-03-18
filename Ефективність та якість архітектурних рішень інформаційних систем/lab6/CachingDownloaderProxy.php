<?php

require_once 'Downloader.php';
require_once 'SimpleDownloader.php';

// Проксі-завантажувач з кешем
class CachingDownloaderProxy implements Downloader
{
  private $downloader; // справжній завантажувач
  private $cache;      // кеш для збереження результатів

  public function __construct()
  {
    $this->downloader = new SimpleDownloader();
    $this->cache = array();
  }

  public function download($url)
  {
    // Якщо немає в кеші — завантажити та зберегти
    if (!isset($this->cache[$url])) {
      $this->cache[$url] = $this->downloader->download($url);
    }

    // Повернути з кешу
    return $this->cache[$url];
  }
}
