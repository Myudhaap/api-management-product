<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponse
{
    protected function successResponse($data, $message, $code = 200)
    {
        return response()->json([
            'statusCode' => $code,
            'message' => $message,
            "data" => $data
        ], $code);
    }

    protected function errorResponse($message, $code = 400, $errors = null)
    {
        throw new HttpResponseException(response([
            'statusCode' => $code,
            'message' => $message,
            "errors" => $errors
        ], $code));
    }
}
