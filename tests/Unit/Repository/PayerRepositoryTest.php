<?php

namespace Tests\Unit\Repository;

use App\Models\Payer;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class SaleRepositoryTest extends TestCase
{
    public function testExistsModel()
    {
        $this->assertTrue(class_exists('App\Repositories\SaleRepository'));
    }

    public function testModel()
    {
        $repository = new SaleRepository(new Container);

        $this->assertEquals(Sale::class, $repository->model());
    }
}
