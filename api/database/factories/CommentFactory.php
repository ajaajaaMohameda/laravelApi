<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;

use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{




    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            // get a model count 

            

        return [
            //
            'body' => [],
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            'post_id' => FactoryHelper::getRandomModelId(Post::class)
        ];
    }
}
