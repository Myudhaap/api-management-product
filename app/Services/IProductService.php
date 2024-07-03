<?php

namespace App\Services;

use App\Http\Requests\ProductCreateReq;
use App\Http\Requests\ProductUpdateReq;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

interface IProductService
{
    public function create(ProductCreateReq $request): ProductResource;
    public function update(ProductUpdateReq $request): ProductResource;
    public function delete(string $id): void;
    public function getAll(Request $request): ProductCollection;
    public function getById(string $id): ProductResource;
}
