<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UsersService;

class UserController extends Controller
{
    public function __construct(
        private readonly UsersService $usersService
    )
    {
    }

    public function index(UserIndexRequest $request)
    {
        $users = $this->usersService->getAll();

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $user = $this->usersService->create($data);
        return UserResource::make($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $this->usersService->update($user, $data);

        return UserResource::make($user);
    }

    public function destroy(User $user)
    {
        return $this->usersService->delete($user);
    }


}
