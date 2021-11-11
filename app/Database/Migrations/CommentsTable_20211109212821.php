<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Migrations;

use Core\Database\Migration;

class CommentsTable_20211109212821
{         
    public function create()
    {
        Migration::disableForeignKeyCheck();

        Migration::createTable('comments')
            ->addPrimaryKey('id')
            ->addBigInt('post_id')
            ->addString('author')
            ->addText('content')
            ->addCurrentTimestamp()
            ->addForeignKey('post_id', 'post')->references('posts', 'id')->onDeleteCascade()->onUpdateCascade()
            ->migrate();

        Migration::enableForeignKeyCheck();
    }
    
    public function drop()
    {
        Migration::disableForeignKeyCheck();
        Migration::dropTable('comments');
        Migration::enableForeignKeyCheck();
    }
}
