<?php

use App\Http\Controllers\ExternalApiController;
use Illuminate\Support\Facades\Route;

Route::get('/external/posts', [ExternalApiController::class, 'posts']);
Route::get('/external/posts/{id}', [ExternalApiController::class, 'show']);
Route::post('/external/posts', [ExternalApiController::class, 'store']);
