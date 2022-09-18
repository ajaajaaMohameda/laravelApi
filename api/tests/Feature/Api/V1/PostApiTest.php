<?php

namespace Tests\Feature\Api\V1;

use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Events\Models\Post\PostUpdated;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostApiTest extends TestCase
{

    use RefreshDatabase;

    protected $uri = '/api/v1/posts';

    public function test_index()
    {
        // Load data in DB

        $posts = Post::factory(10)->create();
        $postsIds = $posts->map(fn($post) => $post->id);

        // call index endpoint

        $response = $this->json('get', $this->uri);
        // dump($response);
        // Assert status

         $response->assertStatus(200);
        // verify records

         $data = $response->json('data');

        // dump($postsIds->toArray());
        collect($data)->each(fn($post) => $this->assertTrue(in_array($post['id'], $postsIds->toArray())));
    }


    public function test_show() 
    {
        $dummy = Post::factory(1)->create()->first();

        $response = $this->json('get', $this->uri.$dummy->id);

        $result = $response->assertStatus(200)->json('data');

        $this->assertEquals($dummy->id, data_get($result, 'id'), 'Response id not the same as model->id');
    }

    public function test_create()
    {
        Event::fake();
        $dummy = Post::factory(1)->make()->first();

        $response = $this->json('post', $this->uri, $dummy->toArray());

        Event::assertDispatched(PostCreated::class);
        $result = $response->assertStatus(201)->json('data');

        // get only fillable attirbutes
        $result = collect($result)->only(array_keys($dummy->getAttributes()));


        $result->each(function($value, $field) use($dummy) {
            $this->assertSame(data_get($dummy, $field), $value, 'Fillable Is no the same');
        });
    }

    public function test_update()
    {

        Event::fake();
        $dummy = Post::factory(1)->create(1)->first();
        $dummy2 = Post::factory(1)->make(1)->first();

        $fillables = collect((new Post())->getFillable());

        $fillables->each(function($fillable) use($dummy, $dummy2) {

            $response = $this->json('patch', $this->uri.'/'.$dummy->id, [
                $fillable => data_get($dummy2, $fillable)
            ]);

            $result = $response->assertStatus(200)->json('data');
            Event::assertDispatched(PostUpdated::class);
            // we should refresh model

            $this->assertEquals(data_get($dummy2, $fillable), data_get($dummy->refresh(), $fillable), 'Failed to update model.');

        });
     
    }

    public function test_delete()
    {
        Event::fake();

        $dummy = Post::factory(1)->create()->first();

        $response = $this->json('delete', $this->uri.'/'.$dummy->id);

        $response->assertStatus(200);
        Event::assertDispatched(PostDeleted::class);

        $this->expectException(ModelNotFoundException::class);

        Post::query()->findOrFail($dummy->id);
    }
}
