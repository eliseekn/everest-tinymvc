<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Actions;

use App\Database\Models\Post;
use Core\Support\Storage;
use Core\Support\Uploader;

class PostActions
{
    public static function create(array $data, Uploader $uploader)
	{
        $uploader->save();

        $data['image'] = $uploader->filename;
        $data['slug'] = slugify($data['title']);

        return Post::create($data);
	}

    public static function update(array $data, int $id, ?Uploader $uploader)
	{
        $post = Post::find($id);

        if (!is_null($uploader)) {
            Storage::path(config('storage.uploads'))->deleteFile($post->image);

            $uploader->save();
            $data['image'] = $uploader->filename;
        }

        $data['slug'] = slugify($data['title']);

        $post->fill($data);
        $post = $post->save();

        return $post;
	}

    public static function delete(int $id)
	{
        $post = Post::find($id);

        Storage::path(config('storage.uploads'))->deleteFile($post->image);

        return $post->delete();
	}
}
