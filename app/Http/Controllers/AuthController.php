<?php

namespace App\Http\Controllers;

use App\Exceptions\ServiceException;
use App\Http\Requests\AuthRegisterReq;
use App\Services\IAuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;
    private IAuthService $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRegisterReq $request): JsonResponse{
        try{
            $authRes = $this->authService->register($request);

            return $this->successResponse($authRes, "Successfully register", 201);
        }catch (ServiceException $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
