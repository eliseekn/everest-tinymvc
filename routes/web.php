<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

use App\Http\Controllers\PostController;
use Core\Routing\Route;

/**
 * Web routes
 */

Route::view('/', 'index')->register();

Route::groupMiddlewares(['auth', 'csrf'], function () {
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::patch('post/{id:num}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{id:num}', [PostController::class, 'delete'])->name('post.delete');
})->register();