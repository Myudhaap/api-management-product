<?php

namespace App\Services;

use App\Http\Requests\CategoryProductCreateReq;
use App\Http\Requests\CategoryProductUpdateReq;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Http\Request;

interface ICategoryService
{
    public function create(CategoryProductCreateReq $request): CategoryProductResource;
    public function update(CategoryProductUpdateReq $request): CategoryProductResource;
    public function delete(string $id): void;
    public function getAll(Request $request): CategoryProductCollection;
    public function getById(string $id): CategoryProductResource;
}
