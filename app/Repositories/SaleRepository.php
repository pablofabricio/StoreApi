<?php

namespace App\Repositories;

use App\Models\Sale;
use Prettus\Repository\Eloquent\BaseRepository;

class SaleRepository extends BaseRepository
{
    public function model()
    {
        return Sale::class;
    }
}
