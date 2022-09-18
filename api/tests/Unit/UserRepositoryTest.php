<?php

namespace Tests\Unit;

use App\Exceptions\GeneralJsonException;
use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

;

class UserRepositoryTest extends TestCase
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
        // Goal: Test if create() will create a record in db

        // Env

        $repositoy = $this->app->make(UserRepository::class);

        // source of truth

        $payload = [
            'name' => 'mohamed',
            'email' => "ajaajaa@gmail.com"
        ];

        // compare

        $user = $repositoy->create($payload);

        $this->assertSame($payload['name'], $user->name, 'User Created does not have the  expected name');

    }

    function test_update()
    {
        // Goal make sure the update methode can update the user
        //2-env 
        $repositoy = $this->app->make(UserRepository::class);

        $dummyData  = User::factory(1)->create()->first();
        // 3- source of thruth;

        $payload = [
            'name' => 'ajaajaa'
        ];

        //4- compare
        $repositoy->update($dummyData, $payload);

        $this->assertSame($payload['name'], $dummyData['name'], 'User updated does not have the same name');
    }

    function test_delete()
    {
        // Test if delete metho can delete a record
        // env
        $repositoy = $this->app->make(UserRepository::class);

        $dummyUser = user::factory(1)->create()->first();

        // 
        $repositoy->forceDelete($dummyUser);

        $user = User::query()->find($dummyUser->id);
        $this->assertSame(null, $user, 'user is not deleted');
    }

    function test_delete_will_throw_exception_when_delete_no_exsisted_record()
    {
        $repositoy = $this->app->make(UserRepository::class);

        $dummyUser = user::factory(1)->make()->first();

        // 
        $this->expectException(GeneralJsonException::class);
        $repositoy->forceDelete($dummyUser);

    }
}
