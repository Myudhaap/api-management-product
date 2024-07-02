<?php

namespace App\Services;

use App\Http\Requests\AuthLoginReq;
use App\Http\Requests\AuthRegisterReq;
use App\Http\Resources\AuthResource;

interface IAuthService
{
    public function register(AuthRegisterReq $request): AuthResource;
    public function login(AuthLoginReq $request): AuthResource;
}
