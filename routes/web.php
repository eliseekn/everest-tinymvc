<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

use App\Http\Controllers\DashboardController;
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
    Route::get('post/{slug:str}', [PostController::class, 'show'])->name('post.show')->middlewares('auth');

    Route::get('dashboard', DashboardController::class)->name('dashboard')->middlewares('auth');
    Route::get('dashboard/comments/{post_id:num}', [DashboardController::class, 'comments'])->name('dashboard.comments')->middlewares('auth');
    Route::get('dashboard/post/create', [PostController::class, 'create'])->name('dashboard.post.create')->middlewares('auth');
    Route::get('dashboard/post/edit/{id:num}', [PostController::class, 'edit'])->name('dashboard.post.edit')->middlewares('auth');
})->register();

Route::post('comment/{post_id:num}', [CommentController::class, 'store'])
    ->name('comment.store')
    ->middlewares('csrf')
    ->register();

Route::delete('comment/{id:num', [CommentController::class, 'delete'])
    ->name('comment.delete')
    ->register();