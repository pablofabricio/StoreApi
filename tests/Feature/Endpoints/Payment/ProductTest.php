<?php

namespace Tests\Feature\Endpoints\Payment;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $token;
    protected array $requestData;

    public function testGetAllProducts()
    {
        Product::factory()->count(3)->create();

        $response = $this->get('/rest/products');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                    '*' => [
                        "id",
                        "name",
                        "description",
                        "price",
                        "created_at",
                        "updated_at",
                    ]
                ]);
    }
}
