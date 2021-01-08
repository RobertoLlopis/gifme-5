<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(200)->create();
        \App\Models\Comment::factory(30)->create();
        \App\Models\LikePost::factory(100)->create();
        \App\Models\DislikePost::factory(100)->create();
        \App\Models\LikeDislikePost::factory(20)->create();
        \App\Models\FollowingUser::factory(100)->create();
    }
}
