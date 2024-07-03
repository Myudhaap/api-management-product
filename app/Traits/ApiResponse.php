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
    protected function successResponsePagination($data, $message, $code = 200)
    {
        $res =  response()->json([
            'statusCode' => $code,
            'message' => $message,
            "data" => $data,
            "pagination" => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ])->setStatusCode(200);

        return $res;
    }

    protected function errorResponse($message, $code = 400, $errors = null)
    {
        throw new HttpResponseException(response([
            'statusCode' => $code != 0 ? $code : 500,
            'message' => $message,
            "errors" => $errors
        ], $code != 0 ? $code : 500));
    }
}
