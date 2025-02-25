<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductRepository
{
    public function findAll(Request $request): LengthAwarePaginator;
    public function findById(string $id): ?Product;
    public function create(Product $product): void;
    public function update(Product $product): Product;
    public function delete(Product $product): void;
}
