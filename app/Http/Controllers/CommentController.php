<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Controllers;

use Core\Http\Request;
use Core\Support\Alert;
use Core\Http\Response\Response;
use App\Http\Actions\CommentActions;
use App\Http\Validators\StoreCommentValidator;

class CommentController
{
    public function store(Request $request, Response $response, int $post_id)
    {
        StoreCommentValidator::make($request->inputs())->redirectBackOnFail($response);

        $data = $request->only('author', 'content');
        $data['post_id'] = $post_id;

        CommentActions::create($data);

        Alert::toast('Comment has been created')->success();
        $response->redirect()->back()->go();
    }

    public function delete(Response $response, int $id)
    {
        CommentActions::delete($id);

        Alert::toast('Comment has been deleted')->success();
        $response->redirect()->back()->go();
    }
}
