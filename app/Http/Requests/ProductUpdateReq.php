<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateReq extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "id" => ["required"],
            "productCategoryId" => ["required"],
            "name" => ["required", "max:100"],
            "price" => ["required", "numeric"],
            "image" => ["required", "file"],
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
