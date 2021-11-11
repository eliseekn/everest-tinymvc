<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

use Core\Support\Storage;
use App\Database\Models\Post;
use App\Database\Models\User;
use Core\Testing\ApplicationTestCase;
use App\Database\Factories\PostFactory;
use App\Database\Factories\UserFactory;
use Core\Testing\Concerns\LoadFaker;
use Core\Testing\Concerns\RefreshDatabase;

class PostTest extends ApplicationTestCase
{
    use RefreshDatabase, LoadFaker;

    public function test_can_not_store_post_if_not_authenticated()
    {
        $post = Post::factory(PostFactory::class)->make([
            'image' => $this->createFileUpload(Storage::path(config('storage.tests'))
                ->file('post-image.svg'), 'image/svg', 'post-image.svg')
        ]);

        $client = $this->post('post', $post->toArray());
        $client->assertSessionHasErrors();
        $client->assertRedirectedToUrl(url('login'));
    }

    public function test_can_store_post()
    {
        $user = User::factory(UserFactory::class)->create(['role' => User::ROLE_ADMIN]);
        
        $post = Post::factory(PostFactory::class)->make([
            'image' => $this->createFileUpload(Storage::path(config('storage.tests'))
                ->file('post-image.svg'), 'image/svg', 'post-image.svg')
        ]);

        $client = $this->actingAs($user)->post('post', $post->toArray());
        $client->assertSessionDoesNotHaveErrors();
        
        $this->assertDatabaseHas('posts', $post->toArray('title', 'content', 'slug'));
    }

    public function test_can_update_post()
    {
        $user = User::factory(UserFactory::class)->create(['role' => User::ROLE_ADMIN]);
        
        $post = Post::factory(PostFactory::class)->make([
            'image' => $this->createFileUpload(Storage::path(config('storage.tests'))
                ->file('post-image.svg'), 'image/svg', 'post-image.svg')
        ]);

        $this->actingAs($user)->post('post', $post->toArray());

        $post = Post::findBy('title', $post->title);
        $post->title = $this->faker->sentence();

        $client = $this->actingAs($user)->patch("post/{$post->id}", $post->toArray());
        $client->assertSessionDoesNotHaveErrors();

        $this->assertDatabaseHas('posts', $post->toArray('title'));
    }

    public function test_can_delete_post()
    {
        $user = User::factory(UserFactory::class)->create(['role' => User::ROLE_ADMIN]);
        
        $post = Post::factory(PostFactory::class)->make([
            'image' => $this->createFileUpload(Storage::path(config('storage.tests'))
                ->file('post-image.svg'), 'image/svg', 'post-image.svg')
        ]);

        $this->actingAs($user)->post('post', $post->toArray());

        $post = Post::findBy('title', $post->title);

        $client = $this->actingAs($user)->delete("post/{$post->id}");

        $client->assertSessionDoesNotHaveErrors();

        $this->assertDatabaseDoesNotHave('posts', $post->toArray('title', 'slug', 'content'));
        $this->assertFileDoesNotExist(Storage::path(config('storage.uploads'))->file($post->image));
    }
}
