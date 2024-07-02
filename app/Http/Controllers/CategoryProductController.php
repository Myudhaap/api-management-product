<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryProductCreateReq;
use App\Http\Requests\CategoryProductUpdateReq;
use App\Services\ICategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    use ApiResponse;

    private ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(CategoryProductCreateReq $request): JsonResponse
    {
        try{
            $category = $this->categoryService->create($request);

            return $this->successResponse($category, "Successfully create category", 201);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(CategoryProductUpdateReq $request, string $id): JsonResponse
    {
        try{
            if($request->id != $id) return $this->errorResponse("bad request", 400);

            $category = $this->categoryService->update($request);

            return $this->successResponse($category, "Successfully update category", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try{
            $this->categoryService->delete($id);

            return $this->successResponse(true, "Successfully delete category", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAll(Request $request): JsonResponse
    {
        try{
            $categories = $this->categoryService->getAll($request);

            return $this->successResponsePagination($categories, "Successfully get all category", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getById(string $id): JsonResponse
    {
        try{
            $category = $this->categoryService->getById($id);

            return $this->successResponse($category, "Successfully get category", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
