<?php

namespace App\Repositories;

use App\Http\Requests\CategoryProductCreateReq;
use App\Http\Requests\CategoryProductUpdateReq;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryProductRepository
{
    public function findAll(Request $request): LengthAwarePaginator;
    public function findById(string $id): ?CategoryProduct;
    public function create(CategoryProduct $category): void;
    public function update(CategoryProduct $category): CategoryProduct;
    public function delete(CategoryProduct $category): void;
}
