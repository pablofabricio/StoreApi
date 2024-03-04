<?php

namespace Tests\Feature\Endpoints\Payment;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $token;
    protected array $requestData;
    protected Sale $sale;
    protected Product $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->sale = Sale::factory()->create();
        $this->product = Product::factory()->create();

        $this->requestData = [
            "products" => [
                [
                    "id" => $this->product->id,
                    "amount" => 3
                ]
            ]
        ];
    }

    public function testGetAllSales()
    {
        Sale::factory()->count(3)->create();

        $response = $this->get('/rest/sales');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                    '*' => [
                        "sales_id",
                        "amount",
                        "products",
                    ]
                ]);
    }

    public function testGetSaleById()
    {
        $response = $this->get('/rest/sales/' . $this->sale->id);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals($this->sale->id, $response['sales_id']);
    }

    
    public function testCreateSale()
    {
        $response = $this->postJson('/rest/sales', $this->requestData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id', 
            'created_at'
        ]);
    }

    public function testAddProductToSale()
    {
        $this->requestData['sale_id'] = $this->sale->id;
        $response = $this->postJson('/rest/sales/products', $this->requestData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
            'id', 
            'updated_at'
        ]);
    }

    public function testDeleteSale()
    {
        $response = $this->delete('/rest/sales/'.$this->sale->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
