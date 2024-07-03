<?php

namespace App\Services\Impl;

use App\Exceptions\ServiceException;
use App\Http\Requests\AuthLoginReq;
use App\Http\Requests\AuthRegisterReq;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Repositories\IAuthRepository;
use App\Services\IAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService implements IAuthService
{
    private IAuthRepository $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(AuthRegisterReq $request): AuthResource
    {
        $data = $request->validated();

        try{
            $data["password"] = Hash::make($data["password"]);
            $user = new User($data);
            $user = $this->authRepository->create($user);

            return new AuthResource($user);
        }catch (\Exception $e){
            throw new ServiceException("Unable to register", 500);
        }
    }

    public function login(AuthLoginReq $request): array
    {
        $data = $request->validated();

        if(! $token = JWTAuth::attempt($data)){
            throw new ServiceException("Invalid credentials", 401);
        }

        $user = Auth::user();
        return [
            "email" => $user->email,
            "token" => $token
        ];
    }

    public function logout(Request $request): void{
        try{
            Auth::logout();
            JWTAuth::invalidate($request->bearerToken());
        }catch (\Exception $e){
            throw new ServiceException("Internal server error", 500);
        }
    }
}
