<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
    ){

    }

    public function catalog(
        array $filters
    ) {
        return $this->repository
            ->paginate($filters);
    }

    public function detail(
        int $id
    ){
        return $this->repository
            ->findById($id);
    }
}
