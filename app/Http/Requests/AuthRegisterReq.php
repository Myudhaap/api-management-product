<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterReq extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "email" => ["required", "max:200", "email"],
            "password" => ["required", "max:200"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->errorResponse(
            "bad request",
            400,
            $validator->getMessageBag()
        );
    }
}
