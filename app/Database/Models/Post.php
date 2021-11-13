<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Models;

use Core\Database\Model;

class Post extends Model
{
    public static $table = 'posts';

    public function __construct()
    {
        parent::__construct(static::$table);
    }

    public function comments()
    {
        return $this->has('comments')->getAll();
    }
}
