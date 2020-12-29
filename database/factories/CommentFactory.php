<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersId = User::all()->pluck('id');
        $postId = Post::all()->pluck('id');
        return [
            'slug' => Str::random(11),
            'description' => $this->faker->sentence(5),
            'user_id' => $this->faker->randomElement($usersId),
            'post_id' => $this->faker->randomElement($postId),
        ];
    }
}
