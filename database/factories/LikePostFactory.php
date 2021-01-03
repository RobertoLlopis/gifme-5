<?php

namespace Database\Factories;

use App\Models\LikePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikePostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikePost::class;

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
            'user_id' => $this->faker->randomElement($usersId),
            'post_id' => $this->faker->randomElement($postId),
            //
        ];
    }
}
