<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

use Core\Support\Storage;
use App\Database\Models\Post;
use App\Database\Models\User;
use App\Database\Models\Comment;
use Core\Testing\ApplicationTestCase;
use App\Database\Factories\PostFactory;
use App\Database\Factories\UserFactory;
use App\Database\Factories\CommentFactory;
use Core\Testing\Concerns\RefreshDatabase;

class CommentTest extends ApplicationTestCase
{
    use RefreshDatabase;

    public function test_can_store_comment()
    {
        $user = User::factory(UserFactory::class)->create(['role' => User::ROLE_ADMIN]);
        
        $post = Post::factory(PostFactory::class)->make([
            'image' => $this->createFileUpload(Storage::path(config('storage.tests'))
                ->file('post-image.svg'), 'image/svg', 'post-image.svg')
        ]);

        $this->actingAs($user)->post('post', $post->toArray());

        $post = Post::findBy('title', $post->title);

        $comment = Comment::factory(CommentFactory::class)->make();

        $client = $this->post("comment/{$post->id}", $comment->toArray());
        $client->assertSessionDoesNotHaveErrors();

        $this->assertDatabaseHas('comments', $comment->toArray());
    }
}
