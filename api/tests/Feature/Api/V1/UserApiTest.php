<?php

namespace Tests\Feature\Api\V1;

use App\Events\User\UserCreated;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserApiTest extends TestCase
{

    use RefreshDatabase;


    protected $uri = '/api/v1/users/';

    public function test_index()
    {
        // Load data in db

        $users = User::factory(10)->create();
        $usersIds = $users->map(fn($user) => $user->id);
        // call index point

        $response = $this->json('get', $this->uri);

        // Assert Statut

        $response->assertStatus(200);
        // verify records

        $data = $response->json('data');

        collect($data)->foreach(fn($user) => $this->assertTrue(in_array($user->id, $users_ids->toArray())));
    }

    public function test_show()
    {
        $dummy = User::factory()->create();

        $response = $this->json('get', $this->uri.$dummy->id);

        $result = $response->assertStatus(200)->json('data');

        $this->assertEquals($dummy->id, data_get($result, 'id'), 'Response id is not aqual as model id');
    }

    public function test_create()
    {
        Event::fake();

        $dummy = User::factory()->make();

        $response = $this->json('post', $this->uri, $dummy->toArray());

        Event::assertDispatched(UserCreated::class);

        $result = $response->assertStatus(201)->json('data');

        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function($field, $value) use($dummy) {
            $this->assertSame(data_get($dummy, $field), $value, 'Fillable is not the same');
        });
    }

    public function test_update()
    {
        Event::fake();

        $dummy = User::factory()->create();
        $dummy2 = User::factory()->make();

        $fillables = 
    }
}
