<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;

Route::get('/', [FirstController::class, 'albums']);
Route::get('/album/{id}', [FirstController::class, 'album'])->where('id', '[0-9]+');
