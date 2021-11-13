<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Controllers;

use App\Database\Models\Comment;
use App\Database\Models\Post;
use App\Http\Actions\PostActions;
use App\Http\Validators\StorePostValidator;
use Core\Http\Request;
use Core\Http\Response\Response;
use Core\Support\Alert;

class PostController
{
    public function __invoke(Response $response)
	{
        $posts = Post::select('*')->paginate(10);

        $response->view('post.index', compact('posts'));
	}

    public function store(Request $request, Response $response)
    {
        StorePostValidator::make($request->inputs())->redirectBackOnFail($response);
        PostActions::create($request->only('title', 'content'), $request->getFiles('image', false, ['jpeg', 'jpg', 'png']));

        Alert::toast('Post has been created')->success();
        $response->redirect()->back()->go();
    }

    public function update(Request $request, Response $response, int $id)
    {
        $data = [];

        if ($request->filled('title')) {
            $data['title'] = $request->title;
        }

        if ($request->filled('content')) {
            $data['content'] = $request->content;
        }

        PostActions::update($data, $id, $request->getFiles('image', false, ['jpeg', 'jpg', 'png']));

        Alert::toast('Post has been updated')->success();
        $response->redirect()->back()->go();
    }

    public function delete(Response $response, int $id)
    {
        PostActions::delete($id);

        Alert::toast('Post has been deleted')->success();
        $response->redirect()->back()->go();
    }

    public function show(Response $response, string $slug)
    {
        $post = Post::findBy('slug', $slug);
        $comments = $post->has('comments')->getAll();

        $response->view('post', compact('post', 'comments'));
    }

    public function create(Response $response)
    {
        $response->view('dashboard.posts.create');
    }

    public function edit(Response $response, int $id)
    {
        $post = Post::find($id);

        $response->view('dashboard.posts.edit', compact('post'));
    }
}
