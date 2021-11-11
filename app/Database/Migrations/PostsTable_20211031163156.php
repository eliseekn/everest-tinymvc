<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Migrations;

use Core\Database\Migration;

class PostsTable_20211031163156
{         
    public function create()
    {
        Migration::createTable('posts')
            ->addPrimaryKey('id')
            ->addString('title')
            ->addString('slug')
            ->addText('content')
            ->addString('image')
            ->addCurrentTimestamp()
            ->migrate();
    }
    
    public function drop()
    {
        Migration::dropTable('posts');
    }
}
