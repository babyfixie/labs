<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalTaskService
{
  protected $baseUrl = 'https://jsonplaceholder.typicode.com';

  public function getPosts()
  {
    $startTime = microtime(true);
    $response = Http::get("{$this->baseUrl}/posts");
    $time = round((microtime(true) - $startTime) * 1000, 2);

    if ($response->successful()) {
      Log::info('Успішний GET-запит (getPosts)', ['time_ms' => $time]);
      return $response->json();
    }

    if ($response->failed()) {
      Log::error('Помилка GET-запиту (getPosts)', ['status' => $response->status(), 'time_ms' => $time]);
      return ['error' => 'Не вдалося отримати записи'];
    }
  }

  public function getPostById($id)
  {
    $startTime = microtime(true);
    $response = Http::get("{$this->baseUrl}/posts/{$id}");
    $time = round((microtime(true) - $startTime) * 1000, 2);

    if ($response->successful()) {
      Log::info("Успішний GET-запит (getPostById, ID: {$id})", ['time_ms' => $time]);
      return $response->json();
    }

    if ($response->failed()) {
      Log::error("Помилка GET-запиту (getPostById)", ['status' => $response->status(), 'time_ms' => $time]);
      return ['error' => 'Запис не знайдено'];
    }
  }

  public function createPost(array $data)
  {
    $startTime = microtime(true);
    $response = Http::post("{$this->baseUrl}/posts", [
      'title' => $data['title'] ?? '',
      'body' => $data['body'] ?? '',
      'userId' => $data['userId'] ?? 1,
    ]);
    $time = round((microtime(true) - $startTime) * 1000, 2);

    if ($response->successful()) {
      Log::info('Успішний POST-запит (createPost)', ['time_ms' => $time]);
      return $response->json();
    }

    if ($response->failed()) {
      Log::error('Помилка POST-запиту (createPost)', ['status' => $response->status(), 'time_ms' => $time]);
      return ['error' => 'Не вдалося створити запис'];
    }
  }
}