<?php

require_once 'CachingDownloaderProxy.php';

// Рендер сторінки
function renderPage($downloader, $url, $pageType)
{
  echo "Rendering [" . $pageType . "] page:\n";
  $data = $downloader->download($url);
  echo "Content: " . $data . "\n\n";
}

$downloader = new CachingDownloaderProxy();

renderPage($downloader, "http://example.com/home", "Home");           // перший запит
renderPage($downloader, "http://example.com/about", "About");         // інший запит
renderPage($downloader, "http://example.com/home", "Home (cached)");  // з кешу
