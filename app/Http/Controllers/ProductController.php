<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductService;

class ProductController
{
    public function __construct(
        private ProductService $service
    ) {}

    public function all()
    {
        return response()->json($this->service->all());
    }
}
