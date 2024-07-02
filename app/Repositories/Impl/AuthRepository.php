<?php

namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\IAuthRepository;

class AuthRepository implements IAuthRepository
{
    public function create(User $user): User
    {
        $user->save();
        return $user;
    }

    public function findById(string $id): ?User
    {
        return User::query()->find($id)->first();
    }
}
