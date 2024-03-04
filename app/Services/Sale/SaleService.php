<?php

namespace App\Services\Sale;

use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function __construct(
        private SaleRepository $saleRepository,
        private ProductRepository $productRepository
    ) {}

    public function all()
    {
        return $this->saleRepository->with('products')->get();
    }

    public function find(int $id)
    {
        $data = $this->saleRepository
            ->with('products')
            ->where('id', $id)
            ->first();
        
        if (empty($data)) {
            throw new \Exception("Sale not found with the specified id", 404);
        }

        return $data;
    }

    public function destroy(int $id): void
    {
        $sale = $this->saleRepository->where('id', $id)->first();
        
        if (empty($sale)) {
            throw new \Exception("Sale not found with the specified id", 404);
        }

        $this->saleRepository->delete($id);
    }

    public function create(array $data)
    {
        if (empty($data)) {
            throw new \Exception("Sale not provided in the request body", 400);
        }

        $data['sale_amount'] = 0;

        DB::beginTransaction();

        try {
            foreach ($data['products'] as $productSale) {
                $product = $this->productRepository->where('id', $productSale['id'])->first();

                $data['sale_amount'] += $product->price * $productSale['amount'];
            }
            
            $sale = $this->saleRepository->create([
                'amount' => $data['sale_amount'],
            ]);
            
            foreach ($data['products'] as $productSale) {
                $sale->products()->attach($productSale['id'], ['amount' => $productSale['amount']]);
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            die($e);

            throw new \Exception('Invalid sale provided.The possible reasons are: A field of the provided sale was null or with invalid values', 422);
        }

        return [
            "id" => $sale->id,
            "created_at" => $sale->created_at
        ];
    }

    public function addProductsToSale(array $data)
    {
        if (empty($data)) {
            throw new \Exception("Sale not provided in the request body", 400);
        }

        $data['sale_amount'] = 0;

        DB::beginTransaction();

        try {
            foreach ($data['products'] as $productSale) {
                $product = $this->productRepository->where('id', $productSale['id'])->first();

                $data['sale_amount'] += $product->price * $productSale['amount'];
            }
            
            $sale = $this->saleRepository->where('id', $data['sale_id'])->first();
            $data['sale_amount'] += $sale->amount;

            $sale = $this->saleRepository->update(['amount' => $data['sale_amount']], $sale->id);
            
            foreach ($data['products'] as $productSale) {
                $sale->products()->attach($productSale['id'], ['amount' => $productSale['amount']]);
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            die($e);

            throw new \Exception('Invalid sale provided.The possible reasons are: A field of the provided sale was null or with invalid values', 422);
        }

        return [
            "id" => $sale->id,
            "updated_at" => $sale->updated_at
        ];
    }
}
