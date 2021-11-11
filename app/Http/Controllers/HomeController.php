<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Controllers;

use Core\Http\Request;
use App\Database\Models\Post;
use Core\Http\Response\Response;

class HomeController
{
    public function __invoke(Request $request, Response $response)
	{
        $posts = Post::select('*')->paginate(10);

        $response->view('home', compact('posts'));
	}
}
