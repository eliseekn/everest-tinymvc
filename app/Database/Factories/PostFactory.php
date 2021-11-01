<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Factories;

use App\Database\Models\Post;
use Core\Database\Factory;

class PostFactory extends Factory
{
    public static $model = Post::class;

    public function __construct(int $count = 1)
    {
        parent::__construct($count);
    }

    public function data()
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $this->faker->paragraph(5),
            'image' => $this->faker->filePath()
        ];
    }
}