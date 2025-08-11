<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/posts', [PageController::class, 'store'])->name('web.posts.store');
