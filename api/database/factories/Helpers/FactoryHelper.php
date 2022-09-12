<?php
namespace Database\Factories\Helpers;


class FactoryHelper 
{
    public static function getRandomModelId(string $model)
    {
        $count = $model::query()->count();
        if($count == 0) {
            $postId = $model::factory()->create()->id;
        } else {
            $postId = rand(1, $count);
        }

        return $postId;
        
    }
}