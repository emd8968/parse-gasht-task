<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UsersService
{

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {

    }

    public function getAll()
    {
        return $this->userRepository->all();
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update($user, array $data)
    {
        $this->userRepository->update($user, $data);

        $user->refresh();

        return $user;
    }

    public function delete($user)
    {
        return $user->delete();
    }

}
