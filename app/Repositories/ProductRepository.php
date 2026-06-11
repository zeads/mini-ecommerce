<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function paginate(
        array $filters
    ): LengthAwarePaginator
    {
        $query = Product::query()
            ->with('category');

        if(
            !empty($filters['search'])
        ){
            $query->where(
                'name',
                'like',
                '%'.$filters['search'].'%'
            );
        }

        if(
            !empty($filters['category'])
        ){
            $query->where(
                'category_id',
                $filters['category']
            );
        }

        return $query
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function findById(
        int $id
    ): Product
    {
        return Product::with('category')
            ->findOrFail($id);
    }
}
