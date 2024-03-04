<?php

namespace App\Http\Controllers;

use App\Http\Resources\SaleResource;
use App\Services\Sale\SaleService;
use Illuminate\Http\Request;

class SaleController
{
    public function __construct(
        private SaleService $service
    ) {}

    public function all()
    {
        return SaleResource::collection($this->service->all());
    }

    public function find(string $id)
    {
        return new SaleResource($this->service->find($id));
    }
    
    public function destroy(string $id)
    {
        $this->service->destroy($id);

        return response()->json(null, 204);
    }

    public function create(Request $request)
    {
        $resource = $this->service->create($request->all());

        return response()->json($resource, 201);
    }

    public function addProductsToSale(Request $request)
    {
        $resource = $this->service->addProductsToSale($request->all());

        return response()->json($resource, 201);
    }
}
