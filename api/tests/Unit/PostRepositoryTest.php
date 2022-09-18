<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Repositories\PostRepository;
use Tests\TestCase;


class PostRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_create()
    {
        //1- Define a goal
        // test if create() will create a record in DB

        //2- Replicate the environment /restriction ex: if we want to test a cart we should authenticate and add items to cart

        $repository = $this->app->make(PostRepository::class);

        // 3-  Define source of truth , expected result

        $payload = [
            'name' => 'ajaajaa',
            'body' => []
        ];

        // 4- Compare 

        $post = $repository->create($payload);

        $this->assertSame($payload['name'], $post->name, 'Post created does not have the same title');

    }

    public function test_update()
    {
        // Goal make sure that the update method can update a post

        // 2- ENv

        $repository = $this->app->make(PostRepository::class);
        $dummyPost = Post::factory(1)->create()[0];

        // 3- source of truth

        $payload = [
            'name' => 'mohamed'
        ];

        // 4- compare 

        $result = $repository->update($dummyPost, $payload);

        $this->assertSame($payload['name'], $result->name, 'Post updated does not have the same title');
    }

    public function test_delete()
    {
        // Goal Test if forceDelete working

        // 2- env 

        $repository = $this->app->make(PostRepository::class);
        $dummyPost = Post::factory(1)->create()->first();

        // compare

        $delted = $repository->forceDelete($dummyPost);
        
        $deltedPost = Post::query()->find($dummyPost->id);
        
        $this->assertSame(null, $deltedPost, 'Post Is not deleted');

    }
}
