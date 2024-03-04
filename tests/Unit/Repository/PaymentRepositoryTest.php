<?php

namespace Tests\Unit\Repository;

use App\Models\Payment;
use App\Models\Product;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testExistsModel()
    {
        $this->assertTrue(class_exists('App\Repositories\ProductRepository'));
    }

    public function testModel()
    {
        $repository = new ProductRepository(new Container);

        $this->assertEquals(Product::class, $repository->model());
    }
}
