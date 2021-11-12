<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Database\Seeds;

use App\Database\Factories\UserFactory;
use App\Database\Models\User;

/**
 * Manage database seeds
 */
class Seeder
{
    public static function run()
    {
        User::factory(UserFactory::class)->create([
            'email' => 'admin@mail.com',
            'password' => hash_pwd('admin'),
            'role' => User::ROLE_ADMIN
        ]);

        User::factory(UserFactory::class)->create([
            'email' => 'user@mail.com',
            'password' => hash_pwd('user'),
            'role' => User::ROLE_USER
        ]);
    }
}
