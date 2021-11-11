<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Factories;

use App\Database\Models\Comment;
use Core\Database\Factory;

class CommentFactory extends Factory
{
    public static $model = Comment::class;

    public function __construct(int $count = 1)
    {
        parent::__construct($count);
    }

    public function data()
    {
        return [
            'author' => $this->faker->email(),
            'content' => $this->faker->sentence()
        ];
    }
}