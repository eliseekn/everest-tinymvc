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
    protected $table = 'posts';

    public function create()
    {
        Migration::createTable($this->table)
            ->addPrimaryKey('id')
            ->addString('title')
            ->addString('slug')
            ->addText('content')
            ->addString('image')
            ->migrate();
    }
    
    public function drop()
    {
        Migration::dropTable($this->table);
    }
}
