<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

Route::apiResource('users', UserController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);

Route::get('users/{user}/posts', [UserController::class, 'posts']);
Route::get('users/{user}/comments', [UserController::class, 'comments']);
Route::get('posts/{post}/comments', [PostController::class, 'comments']);

