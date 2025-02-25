<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return $this->collection->map(function ($resource) use ($request) {
                return (new ProductResource([
                    "product" => $resource,
                    "category" => $resource->categoryProduct
                ]))->toArray($request);
            })->all();
    }
}
