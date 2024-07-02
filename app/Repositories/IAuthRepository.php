<?php

namespace App\Repositories;

use App\Models\User;

interface IAuthRepository
{
    public function create(User $user): User;
    public function findById(string $id): ?User;
}
