<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index']);

Route::post('/', [LinkController::class, 'store'])->middleware('throttle:10,1');
Route::get('/{hash}', [LinkController::class, 'redirect']);
