<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Actions;

use App\Database\Models\Comment;

class CommentActions
{
    public static function create(array $data)
	{
        return Comment::create($data);
	}

    public static function update(array $data, int $id)
	{
        $comment = Comment::find($id);
        $comment->fill($data);
        $comment = $comment->save();

        return $comment;
	}

    public static function delete(int $id)
	{
        $comment = Comment::find($id);
        return $comment->delete();
	}
}
