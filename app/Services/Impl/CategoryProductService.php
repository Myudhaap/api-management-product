<?php

namespace App\Services\Impl;

use App\Exceptions\ServiceException;
use App\Http\Requests\CategoryProductCreateReq;
use App\Http\Requests\CategoryProductUpdateReq;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use App\Repositories\ICategoryProductRepository;
use App\Services\ICategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class CategoryProductService implements ICategoryService
{
    use ApiResponse;
    private ICategoryProductRepository $categoryProductRepository;

    public function __construct(ICategoryProductRepository $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function create(CategoryProductCreateReq $request): CategoryProductResource
    {
        $data = $request->validated();

        try{
            $category = new CategoryProduct($data);
            $this->categoryProductRepository->create($category);

            return new CategoryProductResource($category);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function update(CategoryProductUpdateReq $request): CategoryProductResource
    {
        $data = $request->validated();
        try{
            $category = $this->getById($data["id"]);
            $category= $category->toModel();

            if(isset($data["name"])){
                $category->name = $data["name"];
            }

            $this->categoryProductRepository->update($category);
            return new CategoryProductResource($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function delete(string $id): void
    {
        try{
            $category = $this->getById($id)->toModel();
            $category->is_active = false;

            $this->categoryProductRepository->update($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getAll(Request $request): CategoryProductCollection
    {
        try{
            $categories = $this->categoryProductRepository->findAll($request);
            return new CategoryProductCollection($categories);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getById(string $id): CategoryProductResource
    {
        try{
            $category = $this->categoryProductRepository->findById($id);

            if(is_null($category)){
                throw new ServiceException("Category not found", 404);
            }

            return new CategoryProductResource($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }
}
