<?php

namespace App\Services\Impl;

use App\Exceptions\ServiceException;
use App\Http\Requests\ProductCreateReq;
use App\Http\Requests\ProductUpdateReq;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\IProductRepository;
use App\Services\ICategoryService;
use App\Services\IProductService;
use App\Traits\ApiResponse;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class ProductService implements IProductService
{
    use ApiResponse;

    private IProductRepository $productRepository;
    private ICategoryService $categoryService;
    private FirebaseService $firebaseService;

    public function __construct(
        IProductRepository $productRepository,
        ICategoryService $categoryService,
        FirebaseService $firebaseService
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
        $this->firebaseService = $firebaseService;
    }

    public function create(ProductCreateReq $request): ProductResource
    {
        $data = $request->validated();

        try{
            DB::beginTransaction();

            $product = new Product([
                "product_category_id" => $data["productCategoryId"],
                "name" => $data["name"],
                "price" => $data["price"],
                "image" => $data["image"],
            ]);

            $file = $request->file("image");
            $resUpload = $this->firebaseService->upload($file, "products/");

            $category = $this->categoryService->getById($product->product_category_id);
            $product->image = $resUpload["filePath"];
            $product->imageUrl = $resUpload["fileUpload"]->signedUrl(
                new \DateTime('3000-12-01')
            );

            $this->productRepository->create($product);
            DB::commit();

            return new ProductResource([
                "product" => $product,
                "category" => $category
            ]);
        }catch (ServiceException $e){
            throw $e;
        }
        catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function update(ProductUpdateReq $request): ProductResource
    {
        $data = $request->validated();

        try{
            $product = $this->getById($data["id"]);
            $categoryProduct = $this->categoryService->getById($data["productCategoryId"])->toModel();
            $product= $product->toModel($categoryProduct);

            if(isset($data["name"])){
                $product->name = $data["name"];
            }
            if(isset($data["price"])){
                $product->price = $data["price"];
            }
            if(isset($data["product_category_id"])){
                $product->product_category_id = $data["productCategoryId"];
            }

            if(isset($data["image"])){
                $resUpload = $this->firebaseService->update($data["image"], "products/", $product->image);
                $product->image = $resUpload["filePath"];
                $product->imageUrl = $resUpload["fileUpload"]->signedUrl(
                    new \DateTime('3000-12-01')
                );
            }

            $this->productRepository->update($product);
            return new ProductResource(
                [
                    "product" => $product,
                    "category" => $categoryProduct
                ]
            );
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function delete(string $id): void
    {
        try{
            $product = $this->productRepository->findById($id);
            if(is_null($product)){
                throw new ServiceException("Product not found", 404);
            }

            $product->is_active = false;

            $this->productRepository->update($product);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getAll(Request $request): ProductCollection
    {
        try{
            $products = $this->productRepository->findAll($request);
            return new ProductCollection($products);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getById(string $id): ProductResource
    {
        try{
            $product = $this->productRepository->findById($id);
            if(is_null($product)){
                throw new ServiceException("Product not found", 404);
            }

            $category = $this->categoryService->getById($product->product_category_id);


            return new ProductResource([
                "product" => $product,
                "category" => $category
            ]);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }
}
