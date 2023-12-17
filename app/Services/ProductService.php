<?php

namespace App\Services;

use App\Models\Product;
use Log;

class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getProductsByNameAndCategoryId(array $payload): array {
        $products = Product::with('category')
        ->when(!is_null($payload['categoryId']), function($query) use ($payload) {
            return $query->where('category_id', $payload['categoryId']);
        })->when($payload['productName'] !== '', function($query) use ($payload) {
            return $query->where('name', 'like', '%' . $payload['productName'] . '%');
        })->get();

        return $products->toArray();
    }
}