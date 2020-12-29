<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersId = User::all()->pluck('id');
        $gifs = ['https://i.imgur.com/qR77BXg.gif', 'https://i.imgur.com/OmXJtk7.gif','https://i.imgur.com/0PuBxQ1.gif','https://i.imgur.com/KqGczkp.gif','https://i.imgur.com/xrEIco9.gif', 'https://i.imgur.com/OfFokvn.gif','https://i.imgur.com/WDJZ8rs.gif','https://i.imgur.com/cWnsO9i.gif','https://i.imgur.com/EmZbwOq.gif','https://i.imgur.com/9nSlb23.gif','https://i.imgur.com/SQ2p13v.gif','https://i.imgur.com/FznH4fw.gif','https://i.imgur.com/vj8esda.gif','https://i.imgur.com/x2NZBvD.gif','https://i.imgur.com/KXMJygS.gif','https://i.imgur.com/YV1dkKM.gif'];
        return [
            //
            'slug' => Str::random(11),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(5),
            'gif'=> $this->faker->randomElement($gifs),
            'user_id' => $this->faker->randomElement($usersId),
        ];
    }
}
