<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateReq;
use App\Http\Requests\ProductUpdateReq;
use App\Services\IProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductController extends Controller
{
    use ApiResponse;

    private IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(ProductCreateReq $request): JsonResponse
    {
        try{
            $product = $this->productService->create($request);
            return $this->successResponse($product, "Successfully create product", 201);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(ProductUpdateReq $request, string $id): JsonResponse
    {
        try{
            if($request->id != $id) throw new Exception("bad request", 400);

            $product = $this->productService->update($request);

            return $this->successResponse($product, "Successfully update product", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try{
            $this->productService->delete($id);

            return $this->successResponse(true, "Successfully delete product", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAll(Request $request): JsonResponse
    {
        try{
            $products = $this->productService->getAll($request);
            return $this->successResponsePagination($products, "Successfully get all product", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getById(string $id): JsonResponse
    {
        try{
            $product = $this->productService->getById($id);

            return $this->successResponse($product, "Successfully get product", 200);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
