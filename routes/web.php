<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Core\Routing\Route;
use App\Http\Controllers\PostController;

/**
 * Web routes
 */

Route::get('/', HomeController::class)->register();

Route::groupMiddlewares(['auth', 'csrf'], function () {
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::patch('post/{id:num}', [PostController::class, 'update'])->name('post.update');
    Route::get('post', PostController::class)->name('post.index')->middlewares('auth');
    Route::delete('post/{id:num}', [PostController::class, 'delete'])->name('post.delete')->middlewares('auth');
})->register();

Route::post('comment/{post_id:num}', [CommentController::class, 'store'])
    ->name('comment.store')
    ->middlewares('csrf')
    ->register();
