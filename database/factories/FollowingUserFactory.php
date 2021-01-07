<?php

namespace Database\Factories;

use App\Models\FollowingUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowingUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FollowingUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersId = User::all()->pluck('id');
        $userFollowingId = User::all()->pluck('id');
        return [
            'user_id' => $this->faker->randomElement($usersId),
            'user_following_id' => $this->faker->randomElement($userFollowingId),
            //
        ];
    }
}
