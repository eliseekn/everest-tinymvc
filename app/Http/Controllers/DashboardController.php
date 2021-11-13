<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Controllers;

use App\Database\Models\Comment;
use Core\Http\Request;
use App\Database\Models\Post;
use Core\Http\Response\Response;

class DashboardController
{
    public function __invoke(Request $request, Response $response)
	{
        $posts = Post::select('*')->paginate(10);

        $response->view('dashboard.posts.index', compact('posts'));
	}

    public function comments(Response $response, int $post_id)
    {
        $comments = Comment::where('post_id', $post_id)->paginate(10);
        $post = Post::find($post_id);

        $response->view('dashboard.comments', compact('comments', 'post'));
    }
}
