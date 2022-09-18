<?php

namespace App\Http\Controllers;

use App\Events\user\userCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function index(Request $request)
    {
        event(new userCreated(User::factory()->make()));

        $pageSize = $request->page_size ?? 20;
        $users = User::query()->paginate($pageSize);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function store(Request $request, UserRepository $repository)
    {
        //

        $created = $repository->create($request->only([
            'name',
            'email'
        ]));

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function show(User $user)
    {
        //

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $user
     * @return Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function update(Request $request, User $user,UserRepository $repository)
    {
        //


        $repository->update($user, $request->only([
            'name',
            'email'
        ]));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function destroy(User $user, UserRepository $repository)
    {
      
        $repository->forceDelete($user);

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
    
}
